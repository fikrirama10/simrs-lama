<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
use common\models\StatusHub;
use common\models\Provinsi;
use common\models\Kelurahan;
use common\models\Kabupaten;
use common\models\Kecamatan;
use common\models\Jenispekerjaan;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Pasisen */
/* @var $form yii\widgets\ActiveForm */

?>
<?php $form = ActiveForm::begin(); ?>
	<div class='panel panel-default'>
		<div class='panel-heading'>
			<h4>Detail Pasien Oprasi</h4>
		</div>
		<div class='panel-body'>
			<div class='col-sm-12' style='font-size:15px; line-height:30px;'>
			
				<div class='row param-list bot-dotted'>
					<div class='col-sm-3'>No RM</div>
					<div class='col-sm-9'> : <?= $pasien->no_rekmed;?></div>
				</div>
				<?php ($oprasi->idoprasi)? $oprasi->idoprasi : $oprasi->genKode() ?>
				<?= $form->field($oprasi, 'no_rekmed')->hiddeninput(['value' => $pasien->no_rekmed])->label(false) ?>
				<?= $form->field($oprasi, 'idoprasi')->hiddeninput(['value' => $oprasi->idoprasi])->label(false) ?>
				<?= $form->field($oprasi, 'idrawat')->hiddeninput(['value' => $pasien->idrawat])->label(false) ?>
				<div class='row param-list bot-dotted'>
					<div class='col-sm-3'>Nama Pasien</div>
					<div class='col-sm-9'> : <?= $pasien->pasien->sbb ?>, <?= $pasien->pasien->nama_pasien;?> ( <?= $pasien->pasien->jenis_kelamin ?> )</div>
				</div>
				<div class='row param-list bot-dotted'>
					<div class='col-sm-3'>Tempat Tanggal Lahir</div>
					<div class='col-sm-9'> : <?= $pasien->pasien->tempat_lahir ?>, <?= date('d F Y',strtotime($pasien->pasien->tanggal_lahir)) ?> ( <?= $pasien->pasien->usia ?> th )  </div>
				</div>
				
				<div class='row param-list bot-dotted'>
					<div class='col-sm-3'>No Tlp Pasien</div>
					<div class='col-sm-9'> : <?= $pasien->pasien->nohp ;?></div>
				</div>
				<div class='row param-list bot-dotted'>
					<div class='col-sm-3'>Penanggung Jawab</div>
					<div class='col-sm-9'> : <?= $pasien->penanggung ;?> ( <?= $pasien->hub->hubungan ?> ) </div>
				</div>
				
				<div class='row param-list bot-dotted'>
					<div class='col-sm-3'>Id Oprasi</div>
					<div class='col-sm-9'> : <?= $oprasi->idoprasi ;?></div>
				</div>
				
				
				
				</div>
				
			</div>
			
			
			
			
			
			
		</div>
		<div class='panel-footer'>
			<p>
			
				<?= Html::submitButton('Oprasi', ['class' => 'btn btn-success']) ?>
			
			</p>
			
		</div>
	</div>
	 <?php ActiveForm::end(); ?>
	

