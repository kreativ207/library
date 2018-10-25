<?php
/* @var $searchModel app\modules\admin\models\BooksSearch */
/* @var $model app\modules\admin\models\Books */
/* @var $searchModelName string */
/* @var $modelName string */
/* @var $tableName string */
/* @var $loading_img string */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\StringHelper;

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('index/_js_plugins', ['modelName'=>$modelName, 'loading_img' => $loading_img]);
Yii::$app->view->registerJs($this->render('index/_js_table', ['modelName'=>$modelName, 'loading_img' => $loading_img, 'controller_id' => Yii::$app->controller->id]));
?>


<!-- Этот id нужен для разделения crud-ов, когда на одной странице находится несколько таких таблиц, чтобы на каждую таблицу дейстовали свои кнопки. -->
<!-- This id required for the separation of several crud-s, when some crud-tables are on the same page. Dividing them by the id, the every buttons works for corresponding tables. -->
<div id="<?= $modelName?>-wrapper">

	<!-- The custom validation errors will be displayed in this block -->
	<div id="<?=$modelName?>-errors"></div>

	<?php $form = ActiveForm::begin(['id'=>$modelName.'-form']); ?>

	<div>
		<!-- Additional table header -->
		<?= $this->render('index/_tableHeader') ?>

		<!-- Table -->
		<div class="grid-view">
			<table class="table table-striped table-bordered table-condensed" id="<?=$modelName?>-table">
				<thead>
					<tr>
						<th><input type="checkbox" class="select-all-records-checkbox" onclick="jQuery(this).parents('table').find('tbody td:nth-child('+(jQuery(this).parents('th')[0].cellIndex+1)+') :checkbox').prop('checked', jQuery(this).prop('checked')); jQuery(this).parents('table').find('tbody tr:has(:checkbox)').toggleClass('danger', jQuery(this).prop('checked'));"></th>
						<th>#</th>
						<th data-sort="<?=$tableName?>.id"><a href="#" onclick="return false;"><?=$searchModel->getAttributeLabel('id')?></a></th>
						<th data-sort="<?=$tableName?>.title"><a href="#" onclick="return false;"><?=$searchModel->getAttributeLabel('title')?></a></th>
						<th data-sort="<?=$tableName?>.text"><a href="#" onclick="return false;"><?=$searchModel->getAttributeLabel('text')?></a></th>
						<th data-sort="<?=$tableName?>.count"><a href="#" onclick="return false;"><?=$searchModel->getAttributeLabel('count')?></a></th>
						<th data-sort="<?=$tableName?>.authorName"><a href="#" onclick="return false;"><?=$searchModel->getAttributeLabel('author_id')?></a></th>
						<th style="width:120px;">Actions&nbsp;</th>
					</tr>
					<tr class="filters">
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><input type="text" name="<?=$searchModelName?>[id]" class="form-control search-on-change"></td>
						<td><input type="text" name="<?=$searchModelName?>[title]" class="form-control search-on-change"></td>
						<td><input type="text" name="<?=$searchModelName?>[text]" class="form-control search-on-change"></td>
						<td><input type="text" name="<?=$searchModelName?>[count]" class="form-control search-on-change"></td>
						<td><input type="text" name="<?=$searchModelName?>[authorName]" class="form-control search-on-change"></td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php //echo $this->render('_table', ['dataProvider'=>$dataProvider, 'pk'=>$searchModel->tableSchema->primaryKey]); ?>
				</tbody>
			</table>
		</div>
	</div>

	<?php ActiveForm::end(); ?>
</div>