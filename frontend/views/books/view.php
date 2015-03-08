<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Books */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            //'created_date',
            //'modified_date',
			
			[
				'attribute' => 'created_date',
				'value' => date ("d.m.Y H:i:s", strtotime($model->created_date)),
            ],
			[
				'attribute' => 'modified_date',
				'value' => date ("d.m.Y H:i:s", strtotime($model->modified_date)),
            ],
			
        ],
    ]) ?>
	
	<? $book_id = $model->id; ?>
	<h2>Writers:</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProviderWriters,
        //'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
			[
				'attribute' => 'button',
				'label' => '',
				'format' => 'raw',
				'value' => function ($model) use ($book_id) { return Html::a('Remove', ['bookswriters/remove', 'redirect' => 'books', 'writer_id' => $model->id, 'book_id' => $book_id], [
						'title' => 'Remove the writer from the book',
						'class' => 'btn btn-danger btn-xs',                                  
					]);	
				},
			],

            //'name',
            [
				'attribute' => 'name',
				'format' => 'raw',
				'value' => function ($data) { return Html::a($data->name,['/writers/view', 'id' => $data->id]);},
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
			

            //['class' => 'yii\grid\ActionColumn'],
			
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update}',
				'urlCreator' => function ($action, $model, $key, $index) { return Url::toRoute(['writers/'.$action, 'id' => $key]); }
			],
			
        ],
    ]); 
	?>
	
	

	<? 
	echo Html::a('Add writers', Url::toRoute(['/books-writers/add', 'book_id' => $model->id]), [
		'title' => 'Add writers for book',
		'class' => 'btn btn-success',
	]);	
	?>
	
	<h2>Users:</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProviderUsers,
        //'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
			[
				'attribute' => 'button',
				'label' => '',
				'format' => 'raw',
				'value' => function ($model) use ($book_id) { return Html::a('Remove', ['usersbooks/remove', 'redirect' => 'books', 'user_id' => $model->id, 'book_id' => $book_id], [
						'title' => 'Remove the user from the book',
						'class' => 'btn btn-danger btn-xs',                                  
					]);	
				},
			],

            //'name',
            [
				'attribute' => 'name',
				'format' => 'raw',
				'value' => function ($data) { return Html::a($data->name,['/users/view', 'id' => $data->id]);},
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
			

            //['class' => 'yii\grid\ActionColumn'],
			
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update}',
				'urlCreator' => function ($action, $model, $key, $index) { return Url::toRoute(['users/'.$action, 'id' => $key]); }
			],
			
        ],
    ]); 
	?>
	
	

	<? 
	echo Html::a('Add users', Url::toRoute(['/users-books/add', 'book_id' => $model->id]), [
		'title' => 'Add users for book',
		'class' => 'btn btn-success',
	]);	
	?>
	

</div>
