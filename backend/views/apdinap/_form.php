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
			<div class='col-md-3 formright'>Tanggal</div>
			<div class='col-md-3'><?=	$form->field($model, 'tanggal')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label(false);?>
			</div>
			
		</div>
		<div class='row'>
				<div class='col-md-3 formright'>Nama Petugas</div>
				<div class='col-md-3'><?= $form->field($model, 'petugas')->textInput(['maxlength' => true])->label(false) ?>
				</div>
		</div>
		
		<div class='row'>
				<div class='col-md-3 formright'>Jenis Tindakan</div>
				<div class='col-md-3'>
				<?= $form->field($model, 'tindakan')->textInput(['maxlength' => true])->label(false) ?>
				</div>
				
			</div>
		<div class='row'>
			<div class='col-md-3 formright'>Jenis Apd</div>
			<div class='col-md-6'>
			<div class='row'>
			<div class='col-md-3'><br>
			<?=$form->field($model, 'handscoon', [
					'template' => '{input}{label}{error}{hint}',
					'labelOptions' => ['class' => 'cbx-label']
					])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Handscoon'); 
				?>
			</div>
			<div class='col-md-3'><br>
			<?=$form->field($model, 'masker', [
					'template' => '{input}{label}{error}{hint}',
					'labelOptions' => ['class' => 'cbx-label']
					])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Masker'); 
				?>
			</div>
			<div class='col-md-2'><br>
			<?=$form->field($model, 'apron', [
					'template' => '{input}{label}{error}{hint}',
					'labelOptions' => ['class' => 'cbx-label']
					])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Apron'); 
				?>
			</div>
			</div>
			</div>
		</div><hr>
		<div class='row'>
			<div class='col-md-3'></div>
				<div class='col-md-3'><?=$form->field($model, 'patuh', [
					'template' => '{input}{label}{error}{hint}',
					'labelOptions' => ['class' => 'cbx-label']
					])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Patuh ?'); 
				?></div>
			</div>
			
		</div>
	 <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>

</div>
