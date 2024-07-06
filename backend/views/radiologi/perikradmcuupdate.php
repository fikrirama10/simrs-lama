<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use yii\helpers\Url;
use yii\bootstrap\Modal;
use common\models\Dafrad;
use common\models\Jenisrawat;
use kartik\time\TimePicker;
use kartik\date\DatePicker;
use kartik\checkbox\CheckboxX;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model common\models\Ert */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ert-form">

    <?php $form = ActiveForm::begin(); ?>
	<div class='box box-body'>
	<div class='row'>
		<div class='col-md-1 formright'>No Foto</div>
		<div class='col-md-7'><?= $form->field($model, 'nofoto')->textinput()->label(false) ?>
		</div>
		<div class="col-sm-2 float-left">
							<div class="form-group">
								<button type="button" class="btn btn-default" data-toggle="modal" data-target="#mdBarang"><i class='fa fa-search'></i> Cari Template</button><br>
							</div>
						</div>
		<div class="col-sm-2 float-left">
							<div class="form-group">
								<button type="button" class="btn btn-info" data-toggle="modal" data-target="#mdTemplate"><i class='fa fa-search'></i>Template</button><br>
							</div>
						</div>
		</div>
		<div class='row'>
		<div class='col-md-1 formright'>Pelayanan</div>
		<div class='col-md-7'>   <?= $form->field($model, 'idrad')->dropDownList(ArrayHelper::map(Dafrad::find()->all(), 'id', 'jenispemeriksaan'),['prompt'=>'- Pilih Pelayanan -'])->label(false)?>
	
		</div>
		</div>
		<div class='row'>
		<div class='col-md-1 formright'>Pasien</div>
		<div class='col-md-7'><?= $form->field($model, 'nama')->textinput()->label(false) ?>
		</div>
		</div>
		<div class='row'>
		<div class='col-md-1 formright'>Usia</div>
		<div class='col-md-7'><?= $form->field($model, 'usia')->textinput()->label(false) ?>
		</div>
		</div>
		<div class='row'>
				<div class='col-md-1 formright'>Alamat</div>
				<div class='col-md-7'><?= $form->field($model, 'alamat')->textarea(['rows' => 6])->label(false) ?>
				</div>
		</div>
		<div class='row'>
				<div class='col-md-1 formright'>Tanggal</div>
				<div class='col-md-7'><?=	$form->field($model, 'tanggal')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label(false)?>
				</div>
		</div>
		<div class='row'>
		<div class='col-md-1 formright'>Dokter</div>
		<div class='col-md-7'><?= $form->field($model, 'dokter')->textinput()->label(false) ?>
		</div>
		</div>
		<div class='row'>
		<div class='col-md-1 formright'>Klinis</div>
		<div class='col-md-7'><?= $form->field($model, 'klinis')->textarea(['rows' => 3])->label(false) ?>
		</div>
		</div>
		<div class='row'>
				<div class='col-md-1 formright'>Hasil</div>
				<div class='col-md-7'><?= $form->field($model, 'hasil')->textarea(['rows' => 6])->label(false) ?>
				</div>
		</div>
		<div class='row'>
				<div class='col-md-1 formright'>Kesan</div>
				<div class='col-md-7'><?= $form->field($model, 'kesan')->textarea(['rows' => 6])->label(false) ?>
				</div>
		</div>
		
		
		
		

		</div>
		
	 <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>

</div>
<?php
/*ini modal untuk menampilkan list barang*/
Modal::begin([
	'id' => 'mdBarang',
	'header' => '<h3>Pilih Template</h3>',
	'size'=>'modal-lg',
	'options'=>[
		'data-url'=>'transaksi',
	],
]);

echo '<div class="modalContent">'. $this->render('_dataBarangmcu', ['dataBarang'=>$dataBarang, ]).'</div>';
 
Modal::end();

/*ini modal untuk menampilkan list barang*/
Modal::begin([
	'id' => 'mdTemplate',
	'header' => '<h3>Pilih Template</h3>',
	'size'=>'modal-lg',
	'options'=>[
		'data-url'=>'transaksi',
	],
]);

echo '<div class="modalContent">'. $this->render('_dataTemplate', ['dataTemplate'=>$dataTemplate, ]).'</div>';
 
Modal::end();
?>