<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

?>
<h1>
Add <?= $objects; ?> for
<?= $model->name; ?>
</h1>

<form action="" method="get">
	<input type="hidden" name="BooksWriters[object_id]" value="<?= $model->id; ?>">
	<input type="hidden" name="BooksWriters[objects]" value="<?= $objects ?>">
	<input type="hidden" name="r" value="books-writers/add">
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			
			[
				'attribute' => 'button',
				'label' => '',
				'format' => 'raw',
				'value' => function ($data) use ($objects, $object_ids) { 
					return '<input type="checkbox"'.(isset($object_ids[$data->id]) ? ' disabled="disabled"  checked="checked" ' : '').' name="BooksWriters['.$objects.']['.$data->id.']">'; 
				},
			],

            'name',

        ],
    ]); ?>
	
	<?=  \yii\helpers\BaseHtml::submitButton('Select', [
		'title' => 'Select writer or writers for book',
		'class' => 'btn btn-success',
	]); ?>
	
	<?=  \yii\helpers\BaseHtml::submitButton('Cancel', [
		'title' => 'Cancel',
		'class' => 'btn btn-primary',
		'name' => 'cancel'
	]); ?>
	
</form>