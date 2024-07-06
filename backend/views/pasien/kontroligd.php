<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use common\models\Poli;
use kartik\checkbox\CheckboxX;
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

//$this->title = $model->no_rekmed;
$this->params['breadcrumbs'][] = ['label' => 'Pasien  > IGD', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

   <?php $form = ActiveForm::begin(['options' => ['class' => 'disable-submit-buttons'],]); ?>
	<div class="igd-form"  style='margin-top:20px;'>
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
			</div>
			<div class='col-md-8'>
				<div class='box box-danger'>
					<div class='box box-header'>
					
						<h3>Form  IGD</h3>
					</div>
					<div class='box box-body'>
						<?= $form->field($igd, 'idrawat')->textInput(['value'=>$igd->genKode()]) ?>
						<?= $form->field($lograwat, 'idrawat')->hiddeninput(['value'=>$igd->genKode()])->label(false) ?>
						<?= $form->field($igd, 'no_rekmed')->textInput(['value'=>$model->no_rekmed])?>
						<?= $form->field($lograwat, 'rm')->hiddeninput(['value'=>$model->no_rekmed])->label(false) ?>
						<?= $form->field($igd, 'penanggung')->textInput() ?>
						<?= $form->field($igd, 'hubungan')->dropDownList(ArrayHelper::map(Hubungan::find()->all(), 'id', 'hubungan'),['prompt'=>'- Hubungan Dengan Penanggung -'])->label('Hubungan',['class'=>'label-class'])->label()?>
						<?= $form->field($igd, 'alamat_penanggung')->textarea() ?>
						<?= $form->field($igd, 'notlp')->textInput() ?>
						
						<?= $form->field($igd, 'idbayar')->dropDownList(ArrayHelper::map(Jenisbayar::find()->all(), 'id', 'jenisbayar'),['prompt'=>'- Pilih Jenisbayar -'])->label('',['class'=>'label-class'])->label()?>
							
					<input type="checkbox"  name="Rawatjalan[anggota]" id="lengkap" value="1">Anggota
						
					</div>
				</div>
				<div class='box box-default'>
				<div class='box box-body'>
					<div class="form-grup">
					<?= Html::submitButton('Simpan', ['data' => ['disabled-text' => 'Please Wait'],'class' => 'btn btn-success']) ?>
						
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
