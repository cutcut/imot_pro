<?php

namespace app\controllers;
namespace frontend\controllers;

class UsersBooksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
	
	
	
	public function actionRemove() {
		if (isset($_GET['user_id']) && isset($_GET['book_id'])) {
			\app\models\UsersBooks::deleteAll('user_fk = :user_id AND book_fk = :book_id', [':user_id' => $_GET['user_id'], ':book_id' => $_GET['book_id']]);
			
			if (isset($_GET['redirect'])) {
				if ($_GET['redirect'] == "books") return $this->redirect(['books/view', 'id' => $_GET['book_id']]);
				elseif ($_GET['redirect'] == "users") return $this->redirect(['users/view', 'id' => $_GET['user_id']]);

			}
			else return $this->redirect(['index']);
		}
	}
	
	public function actionAdd() {
	
		if (isset($_GET['UsersBooks']['objects'])) {
			
			if($_GET['UsersBooks']['objects'] == 'users') {
				//print_r($_GET);
			
				$values['UsersBooks']['book_fk'] = $_GET['UsersBooks']['object_id'];
				if (!isset($_GET['cancel']) && isset($_GET['UsersBooks']['user_fk'])) {

					if($model = \app\models\UsersBooks::find()->where(['book_fk' => $values['UsersBooks']['book_fk']])->one()) {
						$model->user_fk = $_GET['UsersBooks']['user_fk'];
						$model->save();
					}
					else {
						$model = new \app\models\UsersBooks();
						$values['UsersBooks']['user_fk'] = $_GET['UsersBooks']['user_fk'];
						$model->load($values);
						$model->save();
					}
	
				}
				return $this->redirect(['books/view', 'id' => $_GET['UsersBooks']['object_id']]);

			}
			elseif($_GET['UsersBooks']['objects'] == 'books'){
				$values['UsersBooks']['user_fk'] = $_GET['UsersBooks']['object_id'];
				if (!isset($_GET['cancel']) && isset($_GET['UsersBooks']['books'])) {
					foreach ($_GET['UsersBooks']['books'] as $book_id => $value) {
						$model = new \app\models\UsersBooks();
						$values['UsersBooks']['book_fk'] = $book_id;
						$model->load($values);
						$model->save();
					}
				}
			
				return $this->redirect(['users/view', 'id' => $_GET['UsersBooks']['object_id']]);

			}
		}
		elseif (isset($_GET['user_id']) || isset($_GET['book_id'])) {
			
			$object_ids = array();
			if (isset($_GET['user_id'])) {
				$objects = "books";
				$id = $_GET['user_id'];
				$model = \app\models\Users::findOne($id);

				$searchModel = new \app\models\BooksSearch();
				foreach($model->books as $book) $object_ids[$book->id] = $book->name; 
				
				$query = new \yii\db\Query();
				
				$dataProvider = new \yii\data\ActiveDataProvider([
					'query' => \app\models\Books::find()->where('NOT EXISTS (SELECT user_fk FROM users_books WHERE books.id = book_fk AND user_fk <> :user_fk)', [':user_fk' => $id]),
					//'query' => $query->select('*')->from('books')->join('LEFT JOIN', 'users_books', 'users_books.book_fk = users_books.book_fk')->where('users_books.user_fk IS NULL'),
					'key' => 'id',
					'pagination' => [
						'pageSize' => 10,
					],
				]);
				
				
			}
			elseif (isset($_GET['book_id'])) {
				$objects = "users";
				$id = $_GET['book_id'];
				$model = \app\models\Books::findOne($id);
				
				$searchModel = new \app\models\UsersSearch();
				foreach($model->users as $user) $object_ids[$user->id] = $user->name;

				$dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
				
			}
			
			
			/*
			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
			*/
			
			return $this->render('add', [
				'objects' => $objects,
				'model' => $model,
				'object_ids' => $object_ids,
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}
		


	}
	
	

}
