<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Writers */

$this->title = 'Create Writers';
$this->params['breadcrumbs'][] = ['label' => 'Writers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="writers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
