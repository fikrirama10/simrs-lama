<?php	
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
use common\models\Diagnosa;
use common\models\Dokter;
use common\models\Triage;
use common\models\Petugas;
use common\models\Pekerjaan;
use common\models\Kesadaran;
use common\models\Tindakandokter;
use common\models\Keadaan;
use yii\helpers\ArrayHelper;
$tindakan = Tindakandokter::find()->where(['kode_rawat'=>$model->idrawat])->all();
?>
<div class='container-fluid'>
	<div class='row'>
		<div class='col-md-4 col-xs-12'>
			<div class='row'>
			
				<div class='col-md-12'>
					
						<div class='box box-default'>
						<div class='box box-body'>
						Triage :<?php 
									if($model->triage == 1){echo" <span class='badge bg-red'>Kategori 1</span>";}
									else if($model->triage == 2){echo" <span class='badge bg-red'>Kategori 2</span>";}
									else if($model->triage == 3){echo" <span class='badge bg-yellow'>Kategori 3</span>";}
									else if($model->triage == 4){echo" <span class='badge bg-green'>Kategori 4</span>";}
								?>
						</div>
					</div>
					<div class='box box-default'>
						<div class='box box-body'>
						Diagnosis : <?= $model->diagnosa->diagnosa ?> ( <?= $model->kdiagnosa?> )
						</div>
					</div>
					<div class='box box-default'>
						<div class='box box-body'>
							Tindakan Yang sudah di berikan :
							 <?php foreach($tindakan as $t): ?>
								<br>- <?= $t->tindakan->namatindakan ?><br>
							 <?php endforeach; ?>
						</div>
						</div>
					<div class='box box-default'>
						<div class='box box-body'>
						<h4>Data Pasien</h4>
						Nama Pasien : <?= $model->pasien->nama_pasien?><br>
						RM			: <?= $model->no_rekmed?><br>
						No Rawat	: <?= $model->idrawat?>
						</div>
						</div>
				</div>
			</div>
			
		</div>
		<?php $form = ActiveForm::begin(); ?>
		<div class='col-md-8'>
			<div class='box box-default'>
				<div class='box box-body'>
				<?= $form->field($rawat, 'rm')->textInput(['value'=>$model->no_rekmed]) ?>
				<?= $form->field($rawat, 'idpengirim')->hiddeninput(['value'=>$model->iddokter])->label(false) ?>
				<?= $form->field($rawat, 'idrawat')->textInput(['value'=>$model->idrawat]) ?>	
				<?= $form->field($rawat, 'ket')->textarea() ?>	
				<label>Pengirim <?= $model->dokter->namadokter ?></label>
				<div class="form-grup">
					<?= Html::submitButton('Kirim', ['class' => 'btn btn-success']) ?>
						
					</div>
				</div>
				
			</div>
		</div>
		<?php ActiveForm::end();  ?>
	</div>
</div>