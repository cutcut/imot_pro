<?php

namespace app\controllers;
namespace frontend\controllers;

class BooksWritersController extends \yii\web\Controller {

	
	public function actionRemove() {
		if (isset($_GET['writer_id']) && isset($_GET['book_id'])) {
			\app\models\BooksWriters::deleteAll('writer_fk = :writer_id AND book_fk = :book_id', [':writer_id' => $_GET['writer_id'], ':book_id' => $_GET['book_id']]);
			
			if (isset($_GET['redirect'])) {
				if ($_GET['redirect'] == "books") return $this->redirect(['books/view', 'id' => $_GET['book_id']]);
				elseif ($_GET['redirect'] == "writers") return $this->redirect(['writers/view', 'id' => $_GET['writer_id']]);

			}
			else return $this->redirect(['index']);
		}
	}
	
	public function actionAdd() {
	
		if (isset($_GET['BooksWriters']['objects'])) {
			if($_GET['BooksWriters']['objects'] == 'writers') {
				$values['BooksWriters']['book_fk'] = $_GET['BooksWriters']['object_id'];
				if (!isset($_GET['cancel']) && isset($_GET['BooksWriters']['writers'])) {
					foreach ($_GET['BooksWriters']['writers'] as $writer_id => $value) {
						$model = new \app\models\BooksWriters();
						$values['BooksWriters']['writer_fk'] = $writer_id;
						$model->load($values);
						$model->save();
					}
				}
				return $this->redirect(['books/view', 'id' => $_GET['BooksWriters']['object_id']]);

			}
			elseif($_GET['BooksWriters']['objects'] == 'books'){
				$values['BooksWriters']['writer_fk'] = $_GET['BooksWriters']['object_id'];
				if (!isset($_GET['cancel']) && isset($_GET['BooksWriters']['books'])) {
					foreach ($_GET['BooksWriters']['books'] as $book_id => $value) {
						$model = new \app\models\BooksWriters();
						$values['BooksWriters']['book_fk'] = $book_id;
						$model->load($values);
						$model->save();
					}
				}
			
				return $this->redirect(['writers/view', 'id' => $_GET['BooksWriters']['object_id']]);

			}
		}
		elseif (isset($_GET['writer_id']) || isset($_GET['book_id'])) {
			$object_ids = array();
			if (isset($_GET['writer_id'])) {
				$objects = "books";
				$id = $_GET['writer_id'];
				$model = \app\models\Writers::findOne($id);

				$searchModel = new \app\models\BooksSearch();
				foreach($model->books as $book) $object_ids[$book->id] = $book->name;
			}
			elseif (isset($_GET['book_id'])) {
				$objects = "writers";
				$id = $_GET['book_id'];
				$model = \app\models\Books::findOne($id);
				
				$searchModel = new \app\models\WritersSearch();
				foreach($model->writers as $writer) $object_ids[$writer->id] = $writer->name;
			}
			
			$dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
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
