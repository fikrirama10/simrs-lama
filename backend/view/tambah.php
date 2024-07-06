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
	<h3>Tambah Stok Obat</h3><hr>
		<div class='row'>
				<div class='col-md-3 formright'>Nama Obat</div>
				<div class='col-md-3'><?= $form->field($model, 'namaobat')->TextInput(['maxlength' => true,'readonly'=>true])->label(false) ?>
				</div>
		</div>
		<div class='row'>
				<div class='col-md-3 formright'>Stok Awal</div>
				<div class='col-md-2'><?= $form->field($model, 'stok')->TextInput(['maxlength' => true,'readonly'=>true])->label(false) ?>
				</div>
				<div class='col-md-1 formleft'><?= $model->satuan->satuan ?></div>
		</div>
		<div class='row'>
			<div class='col-md-3 formright'>Tanggal</div>
			<div class='col-md-3'><?=	$form->field($pembelian, 'tanggal')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label(false);?>
			</div>
			
		</div>
		<div class='row'>
				<div class='col-md-3 formright'>Tambah Stok</div>
				<div class='col-md-3'><?= $form->field($pembelian, 'jumlah')->TextInput(['maxlength' => true,'readonly'=>false])->label(false) ?>
				</div>
				
		</div>
		
		<hr>
		<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>		
		</div>
	
    <?php ActiveForm::end(); ?>

</div>
