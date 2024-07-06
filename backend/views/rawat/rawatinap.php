<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use common\models\Poli;
use common\models\KategoriPenyakit;
use common\models\Jenisbayar;
use kartik\checkbox\CheckboxX;
use common\models\Dokter;
use common\models\Hubungan;
use common\models\Kelas;
use common\models\Kamar;
use kartik\date\DatePicker;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Pasisen */
$kelas = Kelas::find()->all();
//$this->title = $model->no_rekmed;
$this->params['breadcrumbs'][] = ['label' => 'Pasien  > Rawat Inap', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

   <?php $form = ActiveForm::begin(); ?>
	<div class="rawatinap-form"  style='margin-top:20px;'>
	<div class='container-fluid'>

		<div class='row'>
			<div class='col-md-4'>
				<div class='box box-warning'>
					<div class='box box-header'>
						<h3>Data Pasien</h3>
					</div>
					<div class='box box-body'>
						<div class='row'>
							<div class='col-xs-5'>RM</div>
							<div class='col-xs-6'><a>: <?= $model->rm ?></a></div>
						</div>
						<div class='row'>
							<div class='col-xs-5'>Nama Pasien</div>
							<div class='col-xs-6'><a>: <?= $model->pasien->nama_pasien ?></a></div>
						</div>
						<div class='row'>
							<div class='col-xs-5'>Agama</div>
							<div class='col-xs-6'><a>: <?= $model->pasien->agama ?></a></div>
						</div>
						<div class='row'>
							<div class='col-xs-5'>Golongan Darah</div>
							<div class='col-xs-6'><a>: <?= $model->pasien->gol_darah ?></a></div>
						</div>
						<div class='row'>
							<div class='col-xs-5'>Gender</div>
							<div class='col-xs-6'><a>: <?= $model->pasien->jenis_kelamin ?></a></div>
						</div>
					</div>
				</div>
				
			</div>
			<div class='col-md-8'>
				<div class='box box-danger'>
					<div class='box box-header'>
					
						<h3>Form Rawat Inap</h3>
					</div>
					<div class='box box-body'>
						<?= $form->field($rawatinap, 'no_rekmed')->textInput(['value'=>$model->rm]) ?>
						<?= $form->field($rawatinap, 'idrawat')->textInput(['value'=>$model->idrawat]) ?>
						<?= $form->field($rawatinap, 'nosep')->textInput() ?>
						<?= $form->field($rawatinap, 'tglmasuk')->widget(DatePicker::classname(),[
							'type' => DatePicker::TYPE_COMPONENT_APPEND,
							
							'pluginOptions' => [
							'autoclose'=>true,
							'required'=>true,
							'format' => 'yyyy-mm-dd'
							]
						])->label('Tanggal Masuk')?>
						<?= $form->field($rawatinap, 'penanggung')->textInput() ?>
						<?= $form->field($rawatinap, 'hubungan')->dropDownList(ArrayHelper::map(Hubungan::find()->all(), 'id', 'hubungan'),['prompt'=>'- Hubungan Dengan Penanggung -'])->label('Hubungan',['class'=>'label-class'])->label()?>
						<?= $form->field($rawatinap, 'alamat_penanggung')->textarea() ?>
						<?= $form->field($rawatinap, 'notlp')->textInput() ?>
						<?= $form->field($rawatinap, 'idkelas')->dropDownList(ArrayHelper::map(Kelas::find()->all(), 'id', 'namakelas'),['prompt'=>'- Pilih Kelas -','required'=>true,'onchange'=>'$.get("'.Url::toRoute('pasien/lista/').'",{ id: $(this).val() }).done(function( data ) 
							{
								  $( "select#rawatjalan-idruangan" ).html( data );
								});'])->label('Kelas',['class'=>'label-class'])->label()?>
						<?= $form->field($rawatinap, 'idruangan')->dropDownList(ArrayHelper::map(Kamar::find()->where(['id'=>0])->andwhere(['status'=>0])->all(), 'id', 'namaruangan'),['prompt'=>'- Pilih Dokter -','required'=>true])->label('Dokter',['class'=>'label-class'])->label()?>
						<?= $form->field($rawatinap, 'katpenyakit')->dropDownList(ArrayHelper::map(KategoriPenyakit::find()->all(), 'id', 'kategori'),['prompt'=>'- Pilih Jenis Perawatan -','required'=>true])->label('',['class'=>'label-class'])->label()?>
						<?=$form->field($rawatinap, 'oprasi', [
						'template' => '{input}{label}{error}{hint}',
						'labelOptions' => ['class' => 'cbx-label']
						])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Oprasi'); 
						?>
						
						<?= $form->field($rawatinap, 'iddokter')->dropDownList(ArrayHelper::map(Dokter::find()->all(), 'id', 'namadokter'),['prompt'=>'- Pilih Dokter -','required'=>true])->label('Dokter',['class'=>'label-class'])->label()?>
						<?= $form->field($rawatinap, 'idbayar')->dropDownList(ArrayHelper::map(Jenisbayar::find()->all(), 'id', 'jenisbayar'),['prompt'=>'- Pilih Jenisbayar -','required'=>true])->label('',['class'=>'label-class'])->label()?>
						<input type="checkbox" name="Rawatjalan[anggota]" id="lengkap" value="1" class="custom-control-input"  >
					<label class="custom-control-label" for="customCheck1">Anggota</label>
						
					</div>
				</div>
				<div class='box box-default'>
				<div class='box box-body'>
					<div class="form-grup">
					<?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
						
					</div>
				</div>
			</div>
			
			
			
			</div>
		</div>
		
    <div class="form-group">
      
    </div>

    <?php ActiveForm::end(); ?>

		
   
</div>
    

</div>
