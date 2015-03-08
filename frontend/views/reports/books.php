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
				'label' => 'Name',
				'format' => 'raw',
				'value' => function ($data) { return Html::a(\app\models\Books::findOne($data['id'])->name,['/books/view', 'id' => $data['id']]); },

			],
            [
				'label' => 'Count writers',
				'format' => 'raw',
				'value' => function ($data) { return $data['count']; },

			],
        ],
    ]); ?>


</div>
