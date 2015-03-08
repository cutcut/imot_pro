<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

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

	
	<? $user_id = $model->id; ?>
	<h2>Books:</h2>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
      
        'columns' => [
			[
				'attribute' => 'button',
				'label' => '',
				'format' => 'raw',
				'value' => function ($model) use ($user_id) { return Html::a('Remove', ['usersbooks/remove', 'redirect' => 'users', 'user_id' => $user_id, 'book_id' => $model->id], [
						'title' => 'Remove the book from the writer',
						'class' => 'btn btn-danger btn-xs',                                  
					]);	
				},
			],
            [
				'attribute' => 'name',
				'format' => 'raw',
				'value' => function ($data) { return Html::a($data->name,['/books/view', 'id' => $data->id]);},
			],
			[
				'attribute' => 'modified_date',
				'filter' => false,
				'value' => function ($data) { return date ("d.m.Y H:i:s", strtotime($data->modified_date)); },
            ],
			[
				'attribute' => 'created_date',
				'filter' => false,
				'value' => function ($data) { return date ("d.m.Y H:i:s", strtotime($data->created_date)); },
            ],
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} {update}',
				'urlCreator' => function ($action, $model, $key, $index) { return \yii\helpers\Url::toRoute(['books/'.$action, 'id' => $key]); }
			],
			
        ],
    ]); 
	?>
	
	<? 
	echo Html::a('Add books', \yii\helpers\Url::toRoute(['/users-books/add', 'user_id' => $model->id]), [
		'title' => 'Add books for writer',
		'class' => 'btn btn-success',
	]);	
	?>
	
	
	
</div>
