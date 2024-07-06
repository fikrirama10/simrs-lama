<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Indikatorigd */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="indikatorigd-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'namapetugas')->textInput(['maxlength' => true]) ?>
	 <?= $form->field($model, 'jab')->dropDownList([ 'Dpjb' => 'Dpjb', 'Perawat' => 'Perawat', ], ['prompt' => '']) ?>

	
	<div class='box box-body'>
	<div class='col-md-2'>
	<label><h5>SERTIFIKAT BLS</h5></label>
	<?= $form->field($model, 'bls')->radio(['label' => 'Ya', 'value' => 1, 'uncheck' => null]) ?>
	<?= $form->field($model, 'bls')->radio(['label' => 'Tidak', 'value' => 0, 'uncheck' => null]) ?>
	</div>
	<div class='col-md-10'>
    <?=	$form->field($model, 'blsterbit')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					]);?>
	<?=	$form->field($model, 'blshabis')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					]);?>
	</div>
	</div>
	<div class='box box-body'>
	<div class='col-md-2'>
	<label><h5>SERTIFIKAT PPGD</h5></label>
	<?= $form->field($model, 'ppgd')->radio(['label' => 'Ya', 'value' => 1, 'uncheck' => null]) ?>
	<?= $form->field($model, 'ppgd')->radio(['label' => 'Tidak', 'value' => 0, 'uncheck' => null]) ?>
	</div>
	<div class='col-md-10'>
	<?=	$form->field($model, 'ppgdterbit')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					]);?>

	<?=	$form->field($model, 'ppgdhabis')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					]);?>
	</div>
	</div>
		<div class='box box-body'>
	<div class='col-md-2'>
	<label><h5>SERTIFIKAT GELS</h5></label>
	<?= $form->field($model, 'gels')->radio(['label' => 'Ya', 'value' => 1, 'uncheck' => null]) ?>
	<?= $form->field($model, 'gels')->radio(['label' => 'Tidak', 'value' => 0, 'uncheck' => null]) ?>
	</div>
	<div class='col-md-10'>
	<?=	$form->field($model, 'gelsterbit')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					]);?>

	<?=	$form->field($model, 'gelshabis')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					]);?>
	</div>
	</div>
	
	<div class='box box-body'>
	<div class='col-md-2'>
	<label><h5>SERTIFIKAT ALS</h5></label>
	<?= $form->field($model, 'als')->radio(['label' => 'Ya', 'value' => 1, 'uncheck' => null]) ?>
	<?= $form->field($model, 'als')->radio(['label' => 'Tidak', 'value' => 0, 'uncheck' => null]) ?>
	</div>
	<div class='col-md-10'>
	<?=	$form->field($model, 'alsterbit')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					]);?>

	<?=	$form->field($model, 'alshabis')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					]);?>
	</div>
	</div>
   
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
