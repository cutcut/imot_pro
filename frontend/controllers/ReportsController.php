<?php

namespace app\controllers;
namespace frontend\controllers;

class ReportsController extends \yii\web\Controller
{
	public function init() {
		parent::init();
    }
	
    public function actionR_writers() {
		/*
		$query = "SELECT writer_fk AS id, COUNT(DISTINCT user_fk) AS count 
			FROM users_books
			INNER JOIN books_writers ON books_writers.book_fk = users_books.book_fk
			GROUP BY writer_fk
			HAVING count > 3
			ORDER BY NULL
			LIMIT 10";
		*/
		$query = new \yii\db\Query();
		
		$dataProvider = new \yii\data\ActiveDataProvider([
			'query' => $query->select('writer_fk AS id, COUNT(DISTINCT user_fk) AS count')->from('users_books')->join('INNER JOIN', 'books_writers', 'books_writers.book_fk = users_books.book_fk')->groupBy('writer_fk')->having('count > 3'),
			'key' => 'id',
			'pagination' => [
				'pageSize' => 10,
			],
		]);
	
		return $this->render('writers', [
			'title' => 'Report writers',
			'dataProvider' => $dataProvider,
		]);
    }
	
    public function actionR_books() {
		/*
		$query = "SELECT book_fk, COUNT(*) AS count 
			FROM books_writers
			GROUP BY book_fk
			HAVING count > 2
			AND EXISTS(SELECT book_fk FROM users_books WHERE users_books.book_fk = books_writers.book_fk)
			ORDER BY NULL
			LIMIT 10";
		*/
		$query = new \yii\db\Query();
		
		$dataProvider = new \yii\data\ActiveDataProvider([
			'query' => $query->select('book_fk AS id, COUNT(*) AS count')->from('books_writers')->groupBy('book_fk')->having('count > 2 AND EXISTS(SELECT book_fk FROM users_books WHERE users_books.book_fk = books_writers.book_fk)'),
			'key' => 'id',
			'pagination' => [
				'pageSize' => 10,
			],
		]);
	
		return $this->render('books', [
			'title' => 'Report books',
			'dataProvider' => $dataProvider,
		]);
    }
	
    public function actionR3() {
		
		$query = new \yii\db\Query();
		
		$dbname = '';
		if (preg_match('/dbname=([^;]*)/', \Yii::$app->getDb()->dsn, $match)) $dbname = $match[1];
		
		$query->select('AUTO_INCREMENT')->from('INFORMATION_SCHEMA.TABLES')->where('TABLE_SCHEMA = :table_schema AND TABLE_NAME = :table_name', [':table_schema' => $dbname, ':table_name' => 'books']);
		$row = $query->one();
		$max_id = $row['AUTO_INCREMENT'] - 1;
		
		/*
		$query = new \yii\db\Query();
		$query->select('COUNT(*)')->from('books');
		$row = $query->one();
		//$count = $row['count'];
		*/
		$result = array();
		$count = 5;
		if ($count < $max_id) {
		
			$count_step = 10000;
			$count_rows = 0;
			
			while($count_step && $count_rows < $count) {
				$random_id = rand(0, $max_id);var_dump($random_id);
				$query = new \yii\db\Query();
				$query->select('id')->from('books')->where('id = :id', [':id' => $random_id]);
				$row = $query->one();
				
				if ($row['id'] && !isset($result[$row['id']])) {
					$result[$row['id']] = $row['id'];
					$count_rows++;
				}
				
				$count_step--;
			}
			
			$dataProvider = new \yii\data\ActiveDataProvider([
				'query' => \app\models\Books::find()->where(['id' => $result]),
				'key' => 'id',
				'pagination' => [
					'pageSize' => 10,
				],
			]);
			
		}
		else {
			$dataProvider = new \yii\data\ActiveDataProvider([
				'query' => \app\models\Books::find(),
				'key' => 'id',
				'pagination' => [
					'pageSize' => 10,
				],
			]);
		}
		
		return $this->render('random', [
			'title' => '5 random books',
			'dataProvider' => $dataProvider,
		]);
		
    }
	
}
