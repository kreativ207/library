<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Authors */
/* @var $form yii\widgets\ActiveForm */
/* @var $modelName string */

?>

<div class="ajax-form" style="width:800px; background: #f5f5f5; box-shadow: 5px 5px 15px 5px; z-index:105; border-radius:5px;" id="<?= $modelName; ?>-ajax-form">
	<?php $form = ActiveForm::begin([
		'id'=>$modelName.'-form',
		'enableClientValidation' => true,
		'options' => [
			'tabindex' => 2, // It's need to the hot keys works in the form
		],
	]); ?>
	<div class="panel panel-default" style="margin:0;">

		<!-- Form head -->
		<table class="panel-heading" style="width:100%; cursor: move;"><tr>
			<td style="width:24px;"><button type="button" class="close ajax-form-close" aria-label="Close" title="Close" style="font-size:32px; float:none; padding:2px 10px;"><span aria-hidden="true">&times;</span></button></td>
			<td class="ajax-form-title panel-title" style="text-align:center;"><?=$formTitle; ?></td>
			<td style="width:24px;"><button type="button" class="close ajax-form-close" aria-label="Close"  title="Close" style="font-size:32px; float:none; padding:2px 10px;"><span aria-hidden="true">&times;</span></button></td>
		</tr></table>
		
		<!-- Form body -->
		<div class="panel-body ajax-form-body" style="overflow: auto; height:80%;"> <!-- к .ajax-form-body, .ajax-form-footer привязано изменение размера по вертикали, изменение размера по горизонтали привязано к .ajax-form --> <!-- To .ajax-form-body, .ajax-form-footer binded the resizing by vertical, resizing by horizontal binded to .ajax-form -->
			<?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

		</div>
		
		<!-- Form footer -->
		<div class="panel-footer ajax-form-footer">
			<table style="width:100%;"><tr>
				<td style="text-align:left;">
					<?php  if ( ! $model->isNewRecord): ?>
						<button class="ajax-form-button-delete btn btn-danger" type="button" style="margin-right:20px;"><i class="glyphicon glyphicon-trash"></i> Delete</button>
					<?php  endif; ?>
				</td>
				<td style="text-align:right;">
					<button class="ajax-form-button-submit btn btn-success" type="button"><i class="glyphicon glyphicon-ok"></i> Save</button>
					<button class="ajax-form-button-cancel btn btn-warning" type="button" style="margin-left:10px;"><i class="glyphicon glyphicon-remove"></i> Cancel</button>
				</td>
			</tr></table>
		</div>
	</div>
	<?php ActiveForm::end(); ?>
	<div class="resizable" style="cursor:se-resize;position:absolute;bottom:0px;right:0px;width:10px;height:10px;background:#aab;border-bottom-right-radius:3px;"></div>
</div>