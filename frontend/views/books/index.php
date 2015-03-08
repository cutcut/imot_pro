<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Books', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'name',
            [
				'attribute' => 'name',
				'format' => 'raw',
				'value' => function ($data) { return Html::a($data->name,['/books/view', 'id' => $data->id]);},
			],
            //'created_date',
            //'modified_date',
			
			[
				'attribute' => 'modified_date',
				//'format' => ['datetime', 'php:d.m.Y H:i:s'],
				'filter' => false,
				'value' => function ($data) { return date ("d.m.Y H:i:s", strtotime($data->modified_date)); },
            ],
			
			[
				'attribute' => 'created_date',
				//'format' => ['datetime', 'php:d.m.Y H:i:s'],
				'filter' => false,
				'value' => function ($data) { return date ("d.m.Y H:i:s", strtotime($data->created_date)); },
            ],
			

            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update} {delete}',
			],
        ],
    ]); ?>

</div>
