<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Writers */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Writers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="writers-view">

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
	
	<? $writer_id = $model->id; ?>
	<h2>Books:</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      
        //'filterModel' => $searchModel,
        'columns' => [
			//['class' => 'yii\grid\SerialColumn'],
			/*[
			'attribute' => 'books_writers',
			'value' => 'books_writers.book_fk',
			'filter' => yii\helpers\ArrayHelper::map(app\models\ActorRole::find()->orderBy('role_name')->asArray()->all(),'act_role_id','role_name')
			],*/
			[
				'attribute' => 'button',
				'label' => '',
				'format' => 'raw',
				'value' => function ($model) use ($writer_id) { return Html::a('Remove', ['bookswriters/remove', 'redirect' => 'writers', 'writer_id' => $writer_id, 'book_id' => $model->id], [
						'title' => 'Remove the book from the writer',
						'class' => 'btn btn-danger btn-xs',                                  
					]);	
				},
			],
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
			

            //['class' => 'yii\grid\ActionColumn'],
			
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update}',
				'urlCreator' => function ($action, $model, $key, $index) { return Url::toRoute(['books/'.$action, 'id' => $key]); }
			],
			
        ],
    ]); 
	?>
	
	<? 
	echo Html::a('Add books', Url::toRoute(['/books-writers/add', 'writer_id' => $model->id]), [
		'title' => 'Add books for writer',
		'class' => 'btn btn-success',
	]);	
	?>

</div>
