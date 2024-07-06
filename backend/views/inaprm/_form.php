<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\time\TimePicker;
use kartik\date\DatePicker;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model common\models\Ert */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ert-form">

    <?php $form = ActiveForm::begin(); ?>
	<div class='box box-body'>
		
		<div class='row'>
				<div class='col-md-3 formright'>Nama</div>
				<div class='col-md-3'><?= $form->field($model, 'nama')->textInput(['maxlength' => true])->label(false) ?>
				</div>
		</div>
		<div class='row'>
				<div class='col-md-3 formright'>NO RM</div>
				<div class='col-md-3'><?= $form->field($model, 'no_rekmed')->textInput(['maxlength' => true])->label(false) ?>
				</div>
		</div>
		
		<div class='row'>
			<div class='col-md-3 formright'>Tanggal Pasien Pulang</div>
			<div class='col-md-9'><?=	$form->field($model, 'tglpulang')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label(false);?>
			</div>
		</div>
			<div class='row'>
			<div class='col-md-3 formright'>Tanggal Status Kembali</div>
			<div class='col-md-9'><?=	$form->field($model, 'tglskembali')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label(false);?>
			</div>
		</div>
			
			<div class='row'>
			<div class='col-md-3'></div>
				<div class='col-md-3'><?=$form->field($model, 'pengembalian', [
					'template' => '{input}{label}{error}{hint}',
					'labelOptions' => ['class' => 'cbx-label']
					])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Pengembalian RM Setelah 24 Jam '); 
				?></div>
			</div>
			<div class='row'>
			<div class='col-md-3'></div>
				<div class='col-md-3'><?=$form->field($model, 'kelengkapan', [
					'template' => '{input}{label}{error}{hint}',
					'labelOptions' => ['class' => 'cbx-label']
					])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Kelengkapan RM Setelah 24 Jam '); 
				?></div>
			</div>
		</div>
	 <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>

</div>
