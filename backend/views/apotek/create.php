<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\time\TimePicker;
use kartik\date\DatePicker;
use kartik\checkbox\CheckboxX;
use yii\helpers\ArrayHelper;
use common\models\Satuan;
use common\models\Jenisbayar;
use common\models\Katbobat;
use common\models\Katjenis;
/* @var $this yii\web\View */
/* @var $model common\models\Ert */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ert-form">

    <?php $form = ActiveForm::begin(); ?>
	<div class='box box-body'>
	<h3>Tambah Obat</h3><hr>
		<div class='row'>
				<div class='col-md-3 formright'>Nama Obat</div>
				<div class='col-md-3'><?= $form->field($model, 'namaobat')->TextInput(['maxlength' => true])->label(false) ?>
				</div>
		</div>
		<div class='row'>
				<div class ='col-md-3 formright'>Jenis Barang</div>
				<div class ='col-md-3'><?= $form->field($model, 'idjenisobat')->dropDownList(ArrayHelper::map(Jenisbayar::find()->where(['between','id',4,5])->all(), 'id', 'jenisbayar'))->label(false)?></div>
			</div>
		<div class='row'>
				<div class='col-md-3 formright'>Stok Awal</div>
				<div class='col-md-1'><?= $form->field($model, 'stok')->TextInput(['maxlength' => true,])->label(false) ?>
				</div>
				<div class='col-md-2'>
					<?= $form->field($model, 'idsatuan')->dropDownList(ArrayHelper::map(Satuan::find()->all(), 'id', 'satuan'),['prompt'=>'- Satuan -'])->label('',['class'=>'label-class'])->label(false)?>
				</div>
				
		</div>
			<div class='row'>
			<div class='col-md-3 formright'>Tanggal</div>
			<div class='col-md-3'><?=	$form->field($model, 'kadaluarsa')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label(false);?>
			</div>
			
			</div>
			<div class='row'>
				<div class='col-md-3 formright'>Harga Beli</div>
				<div class='col-md-3'><?= $form->field($model, 'hargabeli')->TextInput(['maxlength' => true])->label(false) ?>
				</div>
			</div>
			<div class='row'>
				<div class='col-md-3 formright'>Harga Jual</div>
				<div class='col-md-3'><?= $form->field($model, 'harga')->TextInput(['maxlength' => true])->label(false) ?>
				</div>
			</div>
			<div class='row'>
				<div class='col-md-3 formright'>Kategori Barang</div>
				<div class='col-md-3'>
				<?= $form->field($model,'idjenis')->dropDownList(ArrayHelper::map(Katjenis::find()->all(),'id','katjenis'),[
						'prompt'=>'- Pilih Jenis Barang -',
						'required'=>true,
						'onchange'=>'$.get("'.Url::toRoute('apotek/listbarang/').'",{ id: $(this).val() }).done(function( data ) 
							{
								  $( "select#obat-idkat" ).html( data );
								});
							'
						])->label(false);?>
	
				</div>
			</div>
			<div class='row'>
				<div class='col-md-3 formright'>Kategori</div>
				<div class='col-md-3'>
				<?= $form->field($model, 'idkat')->dropDownList(ArrayHelper::map(Katbobat::find()->all(), 'id', 'kat'),['required'=>true])->label('',['class'=>'label-class'])->label(false)?>
				</div>
			</div>
		
		<hr>
		<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>		
		</div>
	
    <?php ActiveForm::end(); ?>

</div>
