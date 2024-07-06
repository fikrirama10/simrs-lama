<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use common\models\Diagnosis;
use common\models\Rxfisik;
use common\models\Rxlabor;
use common\models\Diagnosa;
use common\models\Tindakan;
use common\models\Tindakandokter;
use common\models\Keluhan;
use common\models\Dokter;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
$rxfisik = Rxfisik::find()->where(['no_rawat'=>$model->idrawat])->one();
$keluhan = Keluhan::find()->where(['kode_p'=>$model->idrawat])->one();
$tindakan = Tindakandokter::find()->where(['kode_rawat'=>$model->idrawat])->all();
$htindakan = Tindakandokter::find()->where(['kode_rawat'=>$model->idrawat])->count();
?>
<?php if($model->iddokter == 0){ ?>
	<h1>Data Dokter Kosong !!</h1>
	<a  href='<?= Yii::$app->params['baseUrl'].'/dashboard/asesmen/update/'.$model->id?>' >Silahkan Klik untuk Mengisi Dokter</a>
<?php }else{ ?>
<div class='container-fluid'>
	<div class='row'>
		<div class='col-md-6'>
			<div class="panel panel-primary">
				<div class="panel-heading">Data Pasien</div>
				<div class="panel-body">
					<div class='row' style='padding-bottom:5px;'>
						<div class='col-md-4 col-xs-11'>Dokter yang menangani </div>
						<div class='col-md-1 col-xs-1'> : </div>
						<div class='col-md-7 col-xs-12'><b><?= $model->dokter->namadokter?></b><br></div>
					</div>
					<div class='row' style='padding-bottom:5px;'>
						<div class='col-md-4 col-xs-11'>Kode Rawat </div>
						<div class='col-md-1 col-xs-1'> : </div>
						<div class='col-md-7 col-xs-12'><b><?= $model->idrawat ?></b><br></div>
					</div>
					<div class='row' style='padding-bottom:5px;'>
						<div class='col-md-4 col-xs-11'>RM </div>
						<div class='col-md-1 col-xs-1'> : </div>
						<div class='col-md-7 col-xs-12'><b><?= $model->no_rekmed ?></b><br></div>
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
					<div class='row'>
						<div class='col-xs-4'> Status </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'><?= $model->sttatus->status ?><br></div>
					</div>
					
				
				</div>
			</div>
			
			<div class="panel panel-success">
						<div class="panel-heading">Tindakan Dokter</div>
						<div class="panel-body">
							<div class='row'>
							 <?php $form = ActiveForm::begin(); ?>
								 
								
								 <?= $form->field($tindakandokter, 'kode_rawat')->hiddeninput(['value'=>$model->idrawat])->label(false); ?>
								 <?= $form->field($tindakandokter, 'no_rekmed')->hiddeninput(['value'=>$model->no_rekmed])->label(false); ?>
								 <?= $form->field($tindakandokter, 'penindak')->hiddeninput(['value'=>$model->iddokter])->label(false); ?>
								<?php if($model->idbayar == 4){?>
								<div class='col-xs-12'> <?= $form->field($tindakandokter, 'idtindakan')->dropDownList(ArrayHelper::map(Tindakan::find()->all(), 'id', 'namatindakan'),['prompt'=>'- Pilih Tindakan -'])?> </div>
								<?php }else{ ?>
								  <div class='col-md-12'> <?= $form->field($tindakandokter, 'tarif')->textinput(['placeholder' => 'KODE TINDAKAN','onkeyup'=>'$.get("'.Url::toRoute('tes/listtindakan/').'",{ id: $(this).val() }).done(function( data ) 
									{
										  $( "select#tindakandokter-tindakann" ).html( data );
										  });']) ?></div>
							<div class='col-md-12'>
								<select id="tindakandokter-tindakann" class="form-control" name='Tindakandokter[tindakann]' aria-invalid="false"></select>
							</div>
						<?php } ?>
								 <div class='col-md-12'> <?= $form->field($prosedur, 'td')->textinput(['placeholder' => 'KODE Prosedur','onkeyup'=>'$.get("'.Url::toRoute('tes/listtindakan/').'",{ id: $(this).val() }).done(function( data ) 
									{
										  $( "select#prosedur-tindakann" ).html( data );
										  });']) ?></div>
							<div class='col-md-12'>
								<select id="prosedur-tindakann" class="form-control" name='Prosedur[tindakann]' aria-invalid="false"></select>
							</div>
								<div class='col-xs-12'> <?= $form->field($tindakandokter, 'ditindakoleh')->textinput(); ?> </div>
								<div class='col-xs-12'><?= Html::submitButton('Tindak', ['class' => 'btn btn-success']) ?></div>
								<?php ActiveForm::end(); ?>
							</div>
						</div>
					</div>
					<div class='box box-body'>
				<table class='table table-bordered'>
					<tr>
						<th>Nama Tindakan</th>
						<th>Dokter</th>
						<th>Di tindak oleh</th>
					</tr>
					<?php foreach($tindakan as $k):?>
					<tr>
						
						<?php if($model->idbayar == 4){ ?>
						<td><?= $k->tindakan->namatindakan ?></td>
						<?php }else{ ?>
						<td><?= $k->tindakann ?></td>
						<?php } ?>
						<td><?= $k->dokter->namadokter ?></td>
						<td><?=$k->ditindakoleh ?></td>
					</tr>
					<?php endforeach; ?>
					</table>
					<?php if($htindakan == 0){echo"";}else{?>
							<a class='btn btn-primary' href='<?= Url::to(['rawatjalan/terapi/'.$model->id]) ?>'>Selesai</a>
							<?php } ?>
			</div>			
			
		</div>
		<div class='col-md-6 col-xs-12'>
			<div class="panel panel-info">
				<div class="panel-heading">Anamnesis</div>
				<div class="panel-body">
					<div class='row'>
						<div class='col-xs-4'> Keluhan Sekarang </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $keluhan->keluhan ?> </div>
					</div>
					<div class='row'>
						<div class='col-xs-4'> Penyakit Sekarang </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $keluhan->rwt_penyakits ?> </div>
					</div>
					<div class='row'>
						<div class='col-xs-4'> Alergi</div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $keluhan->alergi ?> </div>
					</div>
					
			
			</div>	
			</div>	
			<div class="panel panel-warning">
				<div class="panel-heading">Diagnosis Dokter</div>
				<div class="panel-body">
				<div class='row'>
						<div class='col-xs-4'> Diagnosa Dokter</div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $model->kdiagnosa?> <br></div>
					</div>
				
				</div>
			</div>	
			<?php if($model->idpoli == 1){echo"";}else{ ?>
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
					<div class='row'>
						<div class='col-xs-4'> Suhu </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $rxfisik->suhu ?>C° </div>
					</div>
					<div class='row'>
						<div class='col-xs-4'> Tekanan Darah </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $rxfisik->tekanandarah ?> mmHg </div>
					</div>
					<div class='row'>
						<div class='col-xs-4'> Nadi</div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $rxfisik->nadi ?> kali / menit </div>
					</div>
				</div>
			</div>	
			<?php } ?>
			
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
<?php } ?>