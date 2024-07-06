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
			<div class='col-md-9'><?=	$form->field($model, 'tanggal')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label(false);?>
			</div>
		</div>
		<div class='row'>
				<div class='col-md-3 formright'>NO RM</div>
				<div class='col-md-3'><?= $form->field($model, 'no_rekmed')->textInput(['maxlength' => true])->label(false) ?>
				</div>
		</div>
		
		<div class='row'>
				<div class='col-md-3 formright'>Diagnosa</div>
				<div class='col-md-3'>
				<?= $form->field($model, 'idrawat')->textinput(['placeholder' => 'KODE DIAGNOSA','onkeyup'=>'$.get("'.Url::toRoute('tes/listdiagnosa/').'",{ id: $(this).val() }).done(function( data ) 
									{
										  $( "select#ert-diagnosa" ).html( data );
										  });'])->label(false)?>
				</div>
				<div class='col-md-3'><select id="ert-diagnosa" class="form-control" name='Ert[diagnosa]' aria-invalid="false">
			
				</select></div>
			</div>
			<div class='row'>
				<div class='col-md-3 formright'>Jam Datang</div>
				<div class='col-md-3'>
				<?= $form->field($model, 'jamdatang')->widget(TimePicker::classname(), [    'pluginOptions' => [
				'showSeconds' => true,
				'showMeridian' => false,
				'minuteStep' => 1,
				'secondStep' => 5,
				]])->label(false); ?>
				</div>
				<div class='col-md-2 formright'>Jam Dilayani</div>
				<div class='col-md-3'><?= $form->field($model, 'jamdilayani')->widget(TimePicker::classname(), [    'pluginOptions' => [
				'showSeconds' => true,
				'showMeridian' => false,
				'minuteStep' => 1,
				'secondStep' => 5,
				]])->label(false); ?>
				</div>
			</div>
		</div>
	 <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>

</div>
