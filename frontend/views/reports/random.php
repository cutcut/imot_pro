<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WritersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $title;
?>
<div class="reports-index">

    <h1><?= Html::encode($title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
				'template' => '{update}',
				'urlCreator' => function ($action, $model, $key, $index) { return yii\helpers\Url::toRoute(['books/'.$action, 'id' => $key]); }
			],
        ],
    ]); ?>


</div>
