<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
use yii\bootstrap\Modal;
use common\models\Dafusg;
use common\models\Usg;
/* @var $this yii\web\View */
/* @var $model common\models\Usgdetail */
/* @var $form yii\widgets\ActiveForm */
$modelUsg = Usg::find()->where(['idusg'=>$usg->idusg])->one();
?>

<div class="usgdetail-form box box-body">

    <?php $form = ActiveForm::begin(); ?>
	<div class='container-fluid'>
					
				</div>
	<div class='container-fluid'>
		<div class='row'>
		<div class='col-md-4'>
				<div class='row'>
						<h2>Detail Pasien</h2><hr>
						<div class='col-md-12'>
						<table class='table table-bordered'>
							<tr>
								<td width=100>Nama Pasien</td>
								<td width=20>:</td>
								<td><?= $modelUsg->nama?></td>
							</tr>
							<tr>
								<td>No RM</td>
								<td>:</td>
								<td><?= $usg->no_rekmed ?></td>
							</tr>
							<tr>
								<td>Usia</td>
								<td>:</td>
								<td><?= $usg->usia ?> th</td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td>:</td>
								<td><?= $usg->alamat ?></td>
							</tr>
						</table>
						</div>
					</div>
			</div>
			<div class='col-md-8'>
			<div class='row'>
				<div class='col-md-10'>
				<?= $form->field($model, 'idusg')->hiddeninput(['value'=>$usg->idusg,'maxlength' => true,'class' => 'form-control bold'])->label(false) ?>
				<?= $form->field($model, 'idpemeriksaan')->dropDownList(ArrayHelper::map(Dafusg::find()->all(), 'id', 'namausg'),['prompt'=>'- Pilih Pemeriksaan -'])->label('Pemeriksaan',['class'=>'label-class'])->label('Pemeriksaan')?>
				</div>
				<div class='col-md-1'>
								<br>
								<br>
								<button type="button" class="btn btn-info" data-toggle="modal" data-target="#mdTemplate"><i class='fa fa-search'></i>Template</button><br>
						
				</div>
				<div class='col-md-12'>
				<?= $form->field($model, 'nousg')->textInput(['maxlength' => true,'class' => 'form-control bold']) ?>
				<?= $form->field($model, 'judul')->textInput(['maxlength' => true,'class' => 'form-control bold','readonly'=>true]) ?>
				<?= $form->field($model, 'klinis')->textInput(['maxlength' => true,'class' => 'form-control bold']) ?>
				<?= $form->field($model, 'hasil')->textArea(['maxlength' => true,'rows'=>30])->label(false) ?>
				<?= $form->field($model, 'kesimpulan')->textArea(['maxlength' => true,'rows'=>10])->label(false) ?>
				<div class="form-group">
					<?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				</div>
				</div>
				
			</div>
			</div>
			
		</div>
	</div>
    

   
    <?php ActiveForm::end(); ?>

</div>
<?php
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
