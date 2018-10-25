<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ArizeUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="arize-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?/*= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) */?>

    <?= $form->field($model, 'open_pass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tell')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?/*= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'confirmed_at')->textInput() */?>

    <?/*= $form->field($model, 'unconfirmed_email')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'blocked_at')->textInput() */?>

    <?/*= $form->field($model, 'registration_ip')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'created_at')->textInput() */?>

    <?/*= $form->field($model, 'updated_at')->textInput() */?>

    <?/*= $form->field($model, 'flags')->textInput() */?>

    <?= $form->field($model, 'role')->dropDownList(['5' => 'Admin', '10' => 'SuperAdmin']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
