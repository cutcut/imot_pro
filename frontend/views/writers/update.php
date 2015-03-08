<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Writers */

$this->title = 'Update Writers: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Writers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="writers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
