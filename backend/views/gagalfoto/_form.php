<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Gagalfoto */
/* @var $form yii\widgets\ActiveForm */
?>
<div class='box box-body'>
		<div class='row'>
		
    <?php $form = ActiveForm::begin(); ?>
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
				<div class='col-md-3 formright'>Jumlah Pasien</div>
				<div class='col-md-3'><?= $form->field($model, 'jumlah')->textInput(['maxlength' => true])->label(false) ?>
				</div>
		</div>
		<div class='row'>
				<div class='col-md-3 formright'>Jumlah Kegagalan</div>
				<div class='col-md-3'><?= $form->field($model, 'gagal')->textInput(['maxlength' => true])->label(false) ?>
				</div>
		</div>


		<div class='row'>
			<div class='col-md-3 formright'>Jenis Foto</div>
				<div class='col-md-3'> <?=	$form->field($model, 'jenisfoto[]')->widget(Select2::className(),
								[
									'data'=> common\models\Dafrad::getOptions(),
									'options' => [
										'tags' => true,
										'multiple' => true
									],
								]
							)->label(false);
						?>
				</div>
			</div>
			
		</div>
	 <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
