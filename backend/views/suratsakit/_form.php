<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use yii\helpers\Url;
use yii\bootstrap\Modal;
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
		<div class='col-md-2 formright'>NO RM</div>
		<div class='col-md-3'><?= $form->field($model, 'no_rekmed')->textinput()->label(false) ?>
		</div>
		
		<div class="col-sm-2 float-left">
						
		<div class="col-sm-1 float-left">
							<div class="form-group">
								<button type="button" class="btn btn-info" data-toggle="modal" data-target="#mdTemplate"><i class='fa fa-search'></i>Pasien</button><br>
							</div>
						</div>
		</div>
		</div>
		<div class='row'>
		<div class='col-md-2 formright'>Nama Pasien </div>
		<div class='col-md-3'><?= $form->field($model, 'nama')->textinput()->label(false) ?></div>
		<div class='col-md-1 formright'>Usia</div>
				<div class='col-md-2'><?= $form->field($model, 'usia')->textinput()->label(false) ?>
				<?= $form->field($model, 'jk')->hiddeninput()->label(false) ?></div>
				<div class='col-md-1 formright'>Yth</div>
				<div class='col-md-2'> <?= $form->field($model, 'perusahaan')->textinput()->label(false) ?></div>
		</div>
		<div class='row'>
		
		<div class='col-md-2 formright'>Tanggal</div>
				<div class='col-md-3'><?=	$form->field($model, 'tanggal')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd',
					'todayHighlight' => true]
					
					])->label(false);?></div>
				<div class='col-md-1 formright'>Sampai</div>
				<div class='col-md-3'><?=	$form->field($model, 'sampai')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd',
					'todayHighlight' => true]
					
					])->label(false);?></div>
		</div>
		
		
		
		

		</div>
		
	 <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>


</div>
<?php
/*ini modal untuk menampilkan list barang*/


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