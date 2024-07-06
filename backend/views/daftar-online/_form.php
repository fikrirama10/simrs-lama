<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;
use kartik\date\DatePicker;
use common\models\Poli;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Daftaronline */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="daftaronline-form">
	<div class='box box-body' style='padding-top:20px;'>
	
    <?php $form = ActiveForm::begin(); ?>
			<div class='col-md-3'>
			<div class='row'>
					<div class='col-md-2 formright'>Tanggal</div>
					<div class='col-md-10'>
					<?=	$form->field($model, 'tanggal')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label(false);?>
					</div>
			</div>
			</div>
			<div class='col-md-2'>
			<div class='row'>
					<div class='col-md-2 formright'>Jam</div>
					<div class='col-md-10'>
					
					<?= $form->field($model, 'waktu')->widget(TimePicker::classname(), ['pluginOptions' => [
						'showSeconds' => true,
						'showMeridian' => false,
						'minuteStep' => 1,
						'secondStep' => 5,
					]])->label(false); ?>
					</div>
			</div>
			</div>
			<div class='col-md-3'>
			<div class='row'>
					<div class='col-md-2 formright'>Poli</div>
					<div class='col-md-10'>
					<?= $form->field($model, 'idpoli')->dropDownList(ArrayHelper::map(Poli::find()->all(), 'id', 'namapoli'),[
						'prompt'=>'- Pilih Poli -',])->label(false)?>
					</div>
			</div>
			</div>
			<div class='col-md-3'>
			<div class='row'>
					<div class='col-md-2 formright'>Kuota</div>
					<div class='col-md-10'>
					<?= $form->field($model, 'kuota')->textInput(['placeholder'=>'Kuota Daftar Online'])->label(false) ?>
					</div>
			</div>
			</div>
	
	
	
 
    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
