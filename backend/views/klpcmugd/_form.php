<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use common\models\Dokter;
use common\models\Poli;
use common\models\Kamar;
use yii\helpers\Url;
use kartik\checkbox\CheckboxX;
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
				<div class='col-md-3 formright'>No RM</div>
				<div class='col-md-3'><?= $form->field($model, 'no_rekmed')->textInput(['maxlength' => true])->label(false) ?>
				</div>
		</div>
		<div class='row'>
				<div class='col-md-3 formright'>Nama </div>
				<div class='col-md-3'><?= $form->field($model, 'nama')->textInput(['maxlength' => true])->label(false) ?>
				</div>
		</div>

			
		<div class='row'>
			<div class='col-md-3 formright'>Jenis Formulir</div>
				<div class='col-md-5'> <?=	$form->field($model, 'jform[]')->widget(Select2::className(),
								[
									'data'=> common\models\Folmulir::getOptions(),
									'options' => [
										'tags' => true,
										'multiple' => true
									],
								]
							)->label(false);
						?>
				</div>
			</div>
		<div class='row'>
			<div class='col-md-3 formright'>Dpjp</div>
				<div class='col-md-3'> <?= $form->field($model, 'dpjp')->dropDownList(ArrayHelper::map(Dokter::find()->all(), 'id', 'namadokter'),['prompt'=>'- Pilih Dokter -'])->label('Dokter',['class'=>'label-class'])->label(false)?>
				</div>
			</div>
		<div class='row'>
			<div class='col-md-3 formright'>Tidak Lengkap</div>
				<div class='col-md-9'>
			 <?=	$form->field($model, 'tdklengkap[]')->widget(Select2::className(),
								[
									'data'=> common\models\Formtdk::getOptions(),
									'options' => [
										'tags' => true,
										'multiple' => true
									],
								]
							)->label(false);
						?>
				</div>
			</div>
			<div class='row'>
			<div class='col-md-3 formright'>Lengkap</div>
				<div class='col-md-3 form-group'>
					<input type="checkbox"  name="Klpcm[lengkap]" id="lengkap" value="1">
				</div>
			</div>
			
			
		</div>
	 <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
<?php
$databahan = ($model->jform)?$model->jform:'';
$datafinishing= ($model->tdklengkap)?$model->tdklengkap:'';
//$datawarna = ($model->Warna)?$model->Warna:'[""]';

use yii\web\View;
$this->registerJs("
	var ukur = $('#klpcm-jform').val();
	var warna = $('#klpcm-tdklengkap').val();
	
	/*ini untuk selected input select2*/
	if(ukur !== null && warna !== null){
		$('#klpcm-jform').val(".$databahan.").trigger('change');
		$('#klpcm-tdklengkap').val(".$datafinishing.").trigger('change');
		
	}
	


", View::POS_READY);
?>