<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use common\models\Dokter;
use common\models\Kamar;
use yii\web\View;
use kartik\checkbox\CheckboxX;

/* @var $this yii\web\View */
/* @var $model common\models\Gagalfoto */
/* @var $form yii\widgets\ActiveForm */
?>
<div class='box box-body'>
		<div class='row'>
		
    <?php $form = ActiveForm::begin(); ?>
			<div class='col-md-3 formright'>Masuk</div>
			<div class='col-md-3'><?=	$form->field($model, 'tanggal')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label(false);?>
			</div>
			<div class= 'col-md-2'>
			
			</div>
		</div>
		<div class='row'>
				<div class='col-md-3 formright'>Keluar</div>
				<div class='col-md-3'><?=	$form->field($model, 'tglkeluar')->widget(DatePicker::classname(),[
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
			<div class='col-md-3 formright'>Ruangan</div>
				<div class='col-md-3'>
				<?= $form->field($model, 'ruangan')->dropDownList(ArrayHelper::map(Kamar::find()->all(), 'id', 'namaruangan'),['prompt'=>'- Pilih Ruangan -'])->label('Dokter',['class'=>'label-class'])->label(false)?>
				</div>
			</div>
			<div class='row'>
			<div class='col-md-3 formright'>Lengkap</div>
				<div class='col-md-3'>
			
					<?=$form->field($model, 'lengkap', [
					'template' => '{input}{label}{error}{hint}',
					'labelOptions' => ['class' => 'cbx-label']
					])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label(false); 
				?>
				</div>
			</div>
			
		</div>
	 <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
	<?php
	$databahan = ($model->jform)?$model->jform:'';
$datafinishing= ($model->tdklengkap)?$model->tdklengkap:'';
	$this->registerJs("
	//var bahan = $('#barang-ukuran').val();
	//var finishing = $('#barang-warna').val();
	
	/*ini untuk selected input select2*/
	// if(ukur !== null && warna !== null){
		$('#klpcm-jform').val(".$databahan.").trigger('change');
		$('#klpcm-tdklengkap').val(".$datafinishing.").trigger('change');
	//	
	// }
	


", View::POS_READY);
?>
