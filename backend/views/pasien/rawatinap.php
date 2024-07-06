<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use common\models\Poli;
use common\models\Jenisbayar;
use common\models\Dokter;
use common\models\Hubungan;
use common\models\Kelas;
use common\models\Kamar;
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
							<div class='col-xs-6'><a>: <?= $model->no_rekmed ?></a></div>
						</div>
						<div class='row'>
							<div class='col-xs-5'>Nama Pasien</div>
							<div class='col-xs-6'><a>: <?= $model->nama_pasien ?></a></div>
						</div>
						<div class='row'>
							<div class='col-xs-5'>Agama</div>
							<div class='col-xs-6'><a>: <?= $model->agama ?></a></div>
						</div>
						<div class='row'>
							<div class='col-xs-5'>Golongan Darah</div>
							<div class='col-xs-6'><a>: <?= $model->gol_darah ?></a></div>
						</div>
						<div class='row'>
							<div class='col-xs-5'>Gender</div>
							<div class='col-xs-6'><a>: <?= $model->jenis_kelamin ?></a></div>
						</div>
					</div>
				</div>
				<div class='box box-info'>
					<div class='box box-header'>
						<h3>Data Kamar</h3>
					</div>
					<div class='box box-body'>
				
							<?php foreach($kelas as $k):?>
								<h4><?= $k->namakelas ?></h4>
								<?php
									$kamar = Kamar::find()->where(['idkelas'=>$k->id])->all();
									foreach($kamar as $kk):
									?>
									<h5>- <?= $kk->namaruangan ?></h5>
										<p style='text-indent:10px;'>~ Jumlah Tempat Tidur : <?= $kk->tempattidur?></p>
										<p style='text-indent:10px;'>~ Kosong : <?= ($kk->tempattidur - $kk->masuk)?></p>
									<?php endforeach;?>
							<?php endforeach;?>
									
					</div>
				</div>
			</div>
			<div class='col-md-8'>
				<div class='box box-danger'>
					<div class='box box-header'>
					
						<h3>Form Rawat Inap</h3>
					</div>
					<div class='box box-body'>
						<?= $form->field($rawatinap, 'no_rekmed')->textInput(['value'=>$model->no_rekmed]) ?>
						<?= $form->field($rawatinap, 'idrawat')->textInput(['value'=>$model->idrawat]) ?>
						<?= $form->field($rawatinap, 'penanggung')->textInput(['value'=>$model->penanggung]) ?>
						<?= $form->field($rawatinap, 'hubungan')->dropDownList(ArrayHelper::map(Hubungan::find()->all(), 'id', 'hubungan'),['prompt'=>'- Hubungan Dengan Penanggung -'])->label('Hubungan',['class'=>'label-class'])->label()?>
						<?= $form->field($rawatinap, 'alamat_penanggung')->textarea(['value'=>$model->penanggung]) ?>
						<?= $form->field($rawatinap, 'notlp')->textInput(['value'=>$model->penanggung]) ?>
						<?= $form->field($rawatinap, 'idkelas')->dropDownList(ArrayHelper::map(Kelas::find()->all(), 'id', 'namakelas'),['prompt'=>'- Pilih Kelas -','onchange'=>'$.get("'.Url::toRoute('pasien/lista/').'",{ id: $(this).val() }).done(function( data ) 
							{
								  $( "select#rawatjalan-idruangan" ).html( data );
								});'])->label('Kelas',['class'=>'label-class'])->label()?>
						<?= $form->field($rawatinap, 'idruangan')->dropDownList(ArrayHelper::map(Kamar::find()->where(['id'=>0])->andwhere(['status'=>0])->all(), 'id', 'namaruangan'),['prompt'=>'- Pilih Dokter -'])->label('Dokter',['class'=>'label-class'])->label()?>
						
						
						<?= $form->field($rawatinap, 'iddokter')->dropDownList(ArrayHelper::map(Dokter::find()->all(), 'id', 'namadokter'),['prompt'=>'- Pilih Dokter -'])->label('Dokter',['class'=>'label-class'])->label()?>
						<?= $form->field($rawatinap, 'idbayar')->dropDownList(ArrayHelper::map(Jenisbayar::find()->all(), 'id', 'jenisbayar'),['prompt'=>'- Pilih Jenisbayar -'])->label('',['class'=>'label-class'])->label()?>
						
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
