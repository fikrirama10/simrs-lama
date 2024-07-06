<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use common\models\Diagnosis;
use common\models\Rxfisik;
use common\models\Rxlabor;
use common\models\Diagnosa;
use common\models\Obat;
use common\models\Tindakan;
use common\models\Tindakandokter;
use common\models\Keluhan;
use common\models\Resepdokter;
use common\models\Dokter;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
$rxfisik = Rxfisik::find()->where(['no_rawat'=>$model->idrawat])->one();
$keluhan = Keluhan::find()->where(['kode_p'=>$model->idrawat])->one();
$tindakan = Tindakandokter::find()->where(['kode_rawat'=>$model->idrawat])->all();
$resep = Resepdokter::find()->where(['idrawat'=>$model->idrawat])->all();
$htindakan = Resepdokter::find()->where(['idrawat'=>$model->idrawat])->count();
?>
<div class='container-fluid'>
	<div class='row'>
		<div class='col-md-6'>
			<div class="panel panel-primary">
				<div class="panel-heading">Data Pasien</div>
				<div class="panel-body">
					<div class='row'>
						<div class='col-xs-4'>Dokter yang menangani </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'><?= Yii::$app->user->identity->dokter->namadokter?><br></div>
					</div>
					<div class='row'>
						<div class='col-xs-4'> Kode Rawat </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'><?= $model->idrawat ?><br></div>
					</div>
					
					<div class='row'>
						<div class='col-xs-4'> RM </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'><?= $model->no_rekmed ?><br></div>
					</div>
					<div class='row'>
						<div class='col-xs-4'> Nama Pasien </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'><?= $model->pasien->nama_pasien ?><br></div>
					</div>
					
					<div class='row'>
						<div class='col-xs-4'> Jenis Kelamin </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'><?= $model->pasien->jenis_kelamin ?><br></div>
					</div>
					
				
				</div>
			</div>	
			<div class='box box-info' >
						<div class='box box-header'><h4>Tindakan Dokter</h4></div>
						<div class='row'>
							<div class='col-xs-12' style=''>
								<div class='col-xs-12' style='background:#eee; padding:10px 0 10px 0;'>
									
									<div class='col-xs-3'>Nama Tindakan</div>
									<div class='col-xs-3'>Penindak</div>
									<div class='col-xs-4'>Di tindak oleh</div>
								</div>
							</div>
							<?php foreach($tindakan as $k):?>
							<div class='col-xs-12' style=''>
								<div class='col-xs-12' style='border-bottom:1px solid #eee; padding:10px 0 10px 0;'>
									
									<div class='col-xs-3'><?= $k->tindakan->namatindakan ?></div>
									<div class='col-xs-3'><?= $k->dokter->namadokter ?></div>
									<div class='col-xs-4'><?=$k->ditindakoleh ?></b></div>
									
								</div>
								
							</div>
							<?php endforeach; ?>
							
						</div>
				</div>
				<div class='box box-danger' >
						<div class='box box-header'><h4>Resep Dokter</h4></div>
						<div class='row'>
							<div class='col-xs-12' style=''>
								<div class='col-xs-12' style='background:#eee; padding:10px 0 10px 0;'>
									
									<div class='col-xs-3'>Nama Obat</div>
									<div class='col-xs-7'>Dosis</div>
									<div class='col-xs-2'>Jumlah</div>
								</div>
							</div>
							<?php foreach($resep as $r):?>
							<div class='col-xs-12' style=''>
								<div class='col-xs-12' style='border-bottom:1px solid #eee; padding:10px 0 10px 0;'>
									
									<div class='col-xs-3'><?= $r->nobat->namaobat ?></div>
									<div class='col-xs-7'><?= $r->dosis ?>, <?= $r->ket?></div>
									<div class='col-xs-2'><?=$r->jumlah ?></b></div>
									
								</div>
								
							</div>
							<?php endforeach; ?>
							<?php if($htindakan == 0){echo"";}else{?>
							<div class='col-xs-1' style='padding-top:30px; padding-bottom:30px; padding-left:30px;'><a class='btn btn-primary' href='<?= Yii::$app->params['baseUrl'].'/dashboard/rawatjalan/selesai/'.$model->id?>'>Selesai</a></div>
							<?php } ?>
							
						</div>
				</div>
		</div>
		<div class='col-xs-6'>
			<div class="panel panel-info">
				<div class="panel-heading">Keluhan</div>
				<div class="panel-body">
					<div class='row'>
						<div class='col-xs-4'> Keluhan </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $keluhan->keluhan ?> </div>
					</div>
					<div class='row'>
						<div class='col-xs-4'> Riwayat Penyakit Sekarang </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $keluhan->rwt_penyakits ?> </div>
					</div>
					<div class='row'>
						<div class='col-xs-4'> Riwayat Penyakit Dulu </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $keluhan->rwt_penyakitd ?> </div>
					</div>
			
			</div>	
			</div>	
			<div class="panel panel-warning">
				<div class="panel-heading">Diagnosis Dokter</div>
				<div class="panel-body">
				<div class='row'>
						<div class='col-xs-4'> Diagnosa Dokter</div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'><br></div>
					</div>
					
				</div>
			</div>		
			<div class="panel panel-danger">
				<div class="panel-heading">Rx Fisik</div>
				<div class="panel-body">
					<div class='row'>
						<div class='col-xs-4'> Rxfisik </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $rxfisik->rx_fisik ?> </div>
					</div>
					<div class='row'>
						<div class='col-xs-4'> Tinggi Badan </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $rxfisik->tinggibadan ?> cm </div>
					</div>
					<div class='row'>
						<div class='col-xs-4'> Berat Badan </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $rxfisik->beratbadan ?>Kg </div>
					</div>
					<div class='row'>
						<div class='col-xs-4'> Kesadaran </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $rxfisik->kesadarann->kesadaran ?> </div>
					</div>
				</div>
			</div>		
			<div class="panel panel-success">
				<div class="panel-heading">Resep Dokter</div>
				<div class="panel-body">
					<div class='row'>
					 <?php $form = ActiveForm::begin(); ?>
						 
						
						 <?= $form->field($resepdokter, 'idrawat')->hiddeninput(['value'=>$model->idrawat])->label(false); ?>
						<div class='col-xs-12'> <?= $form->field($resepdokter, 'kodeobat')->dropDownList(ArrayHelper::map(Obat::find()->all(), 'noobat', 'namaobat'),['prompt'=>'- Pilih Obat -'])?> </div>
						<div class='col-xs-12'> <?= $form->field($resepdokter, 'dosis')->textinput(); ?> </div>
						<div class='col-xs-12'> <?= $form->field($resepdokter, 'ket')->textinput()->label('Keterangan'); ?> </div>
						<div class='col-xs-12'> <?= $form->field($resepdokter, 'jumlah')->textinput()->label('Jumlah Obat'); ?> </div>
						
							<div class='col-xs-12'><?= Html::submitButton('Catat', ['class' => 'btn btn-success']) ?></div>
							
						
    <?php ActiveForm::end(); ?>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>
<?php 
$this->registerJs("

			$('#tindakandokter-idtindakan').on('change',function() {
                var dob = $('#tindakandokter-idtindakan').val();
                $('#tindakandokter-tarif').val(dob);
            });


", View::POS_READY);
?>
