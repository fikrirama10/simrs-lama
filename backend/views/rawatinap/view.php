<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Tindakandokter;
use common\models\Diagnosajenis;
use common\models\PemeriksaanawalRanap;
use common\models\PemeriksaanRanap;
use common\models\PemeriksaanIgd;
use common\models\Resepdokter;
use common\models\Orderlab;
use common\models\Lab;
use common\models\Radiologi;
use common\models\Radiologidetail;
use yii\helpers\Url;
use common\models\Rawatjalan;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Keluhan;
use common\models\Tableicd;
use common\models\Diagnosaranap;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\web\View;

$rc = Radiologi::find()->where(['idrawat'=>$model->idrawat])->count();
$radiologi = Radiologi::find()->where(['idrawat'=>$model->idrawat])->all();

$orderlabc = Orderlab::find()->where(['idrawat'=>$model->idrawat])->count();
$orderlab = Orderlab::find()->where(['idrawat'=>$model->idrawat])->all();

$periksa_harian = PemeriksaanRanap::find()->where(['idrawat'=>$model->id])->all();
$countpe = PemeriksaanRanap::find()->where(['idrawat'=>$model->id])->count();
$hawri = PemeriksaanawalRanap::find()->where(['idrawat'=>$model->id])->count();
$assesmen = PemeriksaanawalRanap::find()->where(['idrawat'=>$model->id])->one();

$rawat = Rawatjalan::find()->where(['idrawat'=>$model->idrawat])->andwhere(['idjenisrawat'=>3])->one();

$cekrawat = Rawatjalan::find()->where(['idrawat'=>$model->idrawat])->andwhere(['<>','idjenisrawat',2])->one();
if($cekrawat->idjenisrawat == 3){
$cperiksa = PemeriksaanIgd::find()->where(['idrawat'=>$rawat->id])->count();
$pemeriksaan = PemeriksaanIgd::find()->where(['idrawat'=>$rawat->id])->one();
}else{
    $cperiksa =0;
    $pemeriksaan = 0;
}
$data = ArrayHelper::map(Tableicd::find()->all(), 'Kode', 'Kode','Inggris');
$keluhan = Keluhan::find()->where(['kode_p'=>$model->idrawat])->andwhere(['idtkp'=>2])->one();
$tindakan = Tindakandokter::find()->where(['kode_rawat'=>$model->idrawat])->groupBy(['DATE_FORMAT(tgl,"%Y-%m-%d")'])->all();
$resep = Resepdokter::find()->where(['idrawat'=>$model->idrawat])->groupBy(['DATE_FORMAT(tanggal,"%Y-%m-%d")'])->all();
$digd = Rawatjalan::find()->where(['idrawat'=>$model->idrawat])->andwhere(['idjenisrawat'=>3])->one();
$drj = Rawatjalan::find()->where(['idrawat'=>$model->idrawat])->andwhere(['idjenisrawat'=>2])->one();
$drp = Diagnosaranap::find()->where(['idrawat'=>$model->idrawat])->count();
$diag = Diagnosaranap::find()->where(['idrawat'=>$model->idrawat])->all();
$no = 1;
	$formatJs = <<< 'JS'
var formatRepo = function (repo) {
    if (repo.loading) {
        return repo.text;
		
    }
    var marckup =repo.nama;   
    return marckup ;
};
var formatRepoSelection = function (repo) {
    return repo.nama || repo.text;
}
JS;
 
// Register the formatting script
$this->registerJs($formatJs, View::POS_HEAD);
 
// script to parse the results into the format expected by Select2
$resultsJs = <<< JS
function (data) {    
    return {
        results: data,
        
    };
}
JS;
?>

<div class='container-fluid'>
	<div class='row'>
		<div class='col-md-12'>
			<div class='box box-body'>
			<a href='<?= Url::to(['/rawatinap/pulang/'.$model->id]) ?>' class="btn btn-default btn-md">Pulang</a>
			<?php if($model->oprasi == 1){ ?>
			<a href='<?= Yii::$app->params['baseUrl'].'/dashboard/ok/oprasi/'.$model->id?>' class="btn btn-warning btn-md">Oprasi</a>
			<?php }else{echo"";}?>
			</div>
			<div class='box box-body'>
			<h4><?= $model->pasien->sbb ?>, <?= $model->pasien->nama_pasien?> ( <?= $model->pasien->jenis_kelamin?> )</h4>
			<a style='color:grey;'>RM: <?= $model->no_rekmed ?> <b>|</b> No Rawat: <?= $model->idrawat?></a>
			<h6><?= $model->pasien->tempat_lahir?>, <?= date('d F Y',strtotime($model->pasien->tanggal_lahir)) ?> ,<?=$model->pasien->usia?> th</h6>
			<hr>
			<a style='color:grey;'>Penanggung : <?= $model->carabayar->jenisbayar ?></a><br>
			<a style='color:grey;'>Nomor SEP : <?= $model->nosep ?></a><br>
			<hr>
			<a style='color:grey;'><?= $model->pasien->alamat?></a><br>
			<a style='color:grey;'><?= $model->pasien->nohp?></a><br>
			<hr>
			<div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li><a href="#tab_rad" data-toggle="tab">Radiologi</a></li>
              <li><a href="#tab_lab" data-toggle="tab">Laboratorium</a></li>
              <li><a href="#tab_6-3" data-toggle="tab">Diagnosa</a></li>
              <li><a href="#tab_visite" data-toggle="tab">Visite Dokter </a></li>
              <li><a href="#tab_pemeriksaan" data-toggle="tab">Pemeriksaan Pasien Perawat</a></li>
			  <li  class="active"><a href="#tab_3-3" data-toggle="tab">Assesmen Awal Rawat Inap</a></li>
            
              <li class="pull-left header"><i class="fa fa-th"></i><?= $model->kamar->namaruangan ?>  </li>
            </ul>

			  
			  
            <div class="tab-content">
				<div class="tab-pane " id="tab_visite">
					<h4>Visite Dokter</h4>
					 <a href='<?= Url::to(['ranap-visite/create?id='.$model->id])?>' class="btn btn-success btn-md" target='_blank'>+ Pemeriksaan</a>
				</div>
				<div class="tab-pane " id="tab_rad">
					<h4>Pemeriksaan Radiologi</h4>
					<?php if($rc > 0){ ?>
						<table class='table table-bordered'>
							<tr>
								<th>Waktu Pemeriksaan</th>
								<th>Nama Pemeriksaan</th>
							</tr>
							<?php foreach($radiologi as $r){ ?>
							<?php $detail = Radiologidetail::find()->where(['idrad'=>$r->idrad])->all(); ?>
							<tr>
								<td><?= $r->tanggal ?></td>
								<td>
									<?php foreach($detail as $d){ ?>
										<a href='<?= Url::to(['radiologi/printrad/'.$d->id],['target' => '_blank']) ?>'><span class="label label-warning"><?= $d->drad->jenispemeriksaan ?></span></a>
									<?php } ?>
								</td>
							</tr>
							<?php } ?>
						</table>
						
					<?php } ?>
				</div>
				<div class="tab-pane " id="tab_lab">
					<h4>Pemeriksaan Laboratorium</h4>
					<?php if($orderlabc > 0){ ?>
						<table class='table table-bordered'>
							<tr>
								<th>Waktu Pemeriksaan</th>
								<th>Nama Pemeriksaan</th>
								<th>#</th>
							</tr>
							<?php foreach($orderlab as $ol){ ?>
							<?php $lab = Lab::find()->where(['kodelab'=>$ol->kodelab])->all(); ?>
							<tr>
								<td><?= $ol->tgl_order ?></td>
								<td>
									<?php foreach($lab as $l){ ?>
										<?= $l->katlab->nama ?>
									<?php } ?>
								</td>
								<td><a class='btn btn-warning btn-xs' target='_blank' href='<?= Url::to(['/orderlab/printlab/'.$ol->id]) ?>'>Print</a></td>
							</tr>
							<?php } ?>
						</table>
					<?php } ?>
				</div>
				<div class="tab-pane " id="tab_pemeriksaan">
					 <a href='<?= Url::to(['pemeriksaan-ranap/create?id='.$model->id])?>' class="btn btn-success btn-md" target='_blank'>+ Pemeriksaan</a>
					 <?php if($countpe < 1){echo 'Belum Ada Pemeriksaan'; }else{ ?>
						<h3>Pemeriksaan Rawat Inap</h3>
						<table class='table table-bordered table-responsive table-hover table-striped'>
							<thead>
							<tr>
								<th>Waktu Pemeriksaan</th>
								<th>Keadaan Umum</th>
								<th>Keadaan Fisik</th>
								<th>TD</th>
								<th>Respirasi</th>
								<th>Nadi</th>
								<th>Suhu</th>
								<th>Lab</th>
								<th>Radiologi</th>
							<tr>
							</thead>
							<tbody>
							<?php foreach($periksa_harian as $ph){ ?>
							<tr>
								<td><?= date('Y/m/d',strtotime($ph->tanggal)) ?> <?= $ph->jam ?> </td>
								<td><?= $ph->keadaanumum ?></td>
								<td><?= $ph->keadaanfisik ?></td>
								<td><?= $ph->td ?></td>
								<td><?= $ph->respirasi ?></td>
								<td><?= $ph->nadi ?></td>
								<td><?= $ph->suhu ?></td>
								<td><?= $ph->pecah($ph->lab) ?></td>
								<td><?= $ph->pecah($ph->radiologi) ?></td>
							</tr>
							<?php }?>
					 </tbody>
					 </table>
					 <?php } ?>
				</div>
				
              <div class="tab-pane " id="tab_1-1">
              <a href='<?= Yii::$app->params['baseUrl'].'/dashboard/rawatinap/createtindakan/'.$model->id?>' class="btn btn-success btn-md">+ Tindakan</a>
			  <div class='row'>
			  <div class='col-md-12'>
				<div class='box-body'>
				<?php foreach($tindakan as $t):?>
				<?php $tgl=date('Y-m-d',strtotime($t->tgl)); ?>
				<h4><?= date('d F Y',strtotime($t->tgl)) ?></h4>
					<?php $ttt= Tindakandokter::find()->where(['DATE_FORMAT(tgl,"%Y-%m-%d")'=>$tgl])->andwhere(['kode_rawat'=>$model->idrawat])->andwhere(['idtkp'=>$model->idjenisrawat])->all();
					?>
					 
					<table class="table table-bordered">
					<tr>
						<th>Nama Tindakan</th>
						<th>Dokter Penanggung Jawab</th>
						<th>Jam Tindakan</th>
						<th>Tempat Tindakan</th>
					
					</tr>
					<?php foreach($ttt as $t):?>
						<tr>
							<td><?= $t->tindakandokter->namatindakan ?></td>
							<td><?= $t->dokter->namadokter ?></td>
							<td></td>
							<td><a href='<?= Url::to(['rawatinap/delete/'.$t->id]) ?>'><span class="label label-danger"><i class="fa fa-close"></i></span></a></td>
						</tr>
	<?php endforeach; ?>
				</table>
				<hr>
				<?php endforeach; ?>	
			
				</div>
			  </div>
			  </div>
			  
				
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2-2">
				<a href='<?= Yii::$app->params['baseUrl'].'/dashboard/rawatinap/createresep/'.$model->id?>' class="btn btn-success btn-md">+ Obat</a>
				<div class='row'>
				<div class='col-md-12'>
				<div class='box-body'>
				<?php foreach($resep as $r):?>
				<?php $tanggal=date('Y-m-d',strtotime($r->tanggal)); ?>
				<h4><?= date('d F Y',strtotime($r->tanggal)) ?></h4>
					<?php $rrr= Resepdokter::find()->where(['DATE_FORMAT(tanggal,"%Y-%m-%d")'=>$tanggal])->andwhere(['idrawat'=>$r->idrawat])->all();
					?>
					
					<table class="table table-bordered">
					<tr>
						<th>Nama Obat</th>
						<th>Jumlah</th>
						<th>Dosis</th>
						<th>Keterangan</th>
						<th>Jam</th>
					
					</tr>
				<?php foreach($rrr as $rr): ?>
					<tr>
						<td><?= $rr->nobat->namaobat ?></td>
						<td><?= $rr->jumlah ?></td>
						<td><?= $rr->dosis ?></td>
						<td><?= $rr->ket ?></td>
						<td><?= date('G:i A',strtotime($rr->tanggal)) ?></td>
					</tr>
				<?php endforeach; ?>
				</table>
				<hr>
				<?php endforeach; ?>	
			
				</div>
				</div>
				</div>
				  
              </div>

			  <div class="tab-pane active" id="tab_3-3">
				<h3>Assesmen Awal Rawat Inap</h3>
				<?php if($hawri < 1){?>
				 <a href='<?= Url::to(['awal-ranap/create?id='.$model->id])?>' class="btn btn-success btn-md" target='_blank'>+ Pemeriksaan Awal</a>
				<?php }else{ ?>
				<div class='box box-body'>
					<div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                      Pemeriksaan Awal Rawat Inap
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="box-body">
						<div class='row'>
							<div class='col-md-6'>
								<h5>Data Pemeriksaan Awal Rawat Inap</h5>
								<table class='table table-bordered'>
									<tr>
										<th width=200>Tanggal Masuk</th>
										<td><?= date('Y / m / d',strtotime($model->tglmasuk)) ?></td>
									</tr>
									<tr>
										<th width=200>Jam Masuk</th>
										<td><?= $assesmen->jam_masuk ?></td>
									</tr>
									<tr>
										<th width=200>DPJP</th>
										<td><?= $model->dokter->namadokter ?></td>
									</tr>
									<tr>
										<th width=200>Anamnesa</th>
										<td><?= $assesmen->anamnesa ?></td>
									</tr>
									<tr>
										<th>Keadaan Fisik</th>
										<td><?= $assesmen->fisik ?></td>
									</tr>
									<tr>							
										<th>Diagnosa Masuk</th>
										<td><?= $assesmen->diagnosa_awal ?></td>
									</tr>
								</table>
								<h5>Pemeriksaan Fisik </h5>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">TD</span>
									<input type='text' class='form-control' readonly value='<?= $assesmen->td ?> mmHg'>	
									<span class="input-group-addon" id="basic-addon1">Nadi</span>
									<input type='text' class='form-control' readonly value='<?= $assesmen->nadi ?> x/menit'>	
								</div>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Respirasi</span>
									<input type='text' class='form-control' readonly value='<?= $assesmen->respirasi ?> x/menit'>	
									<span class="input-group-addon" id="basic-addon1">Suhu</span>
									<input type='text' class='form-control' readonly value='<?= $assesmen->suhu ?> C'>	
								</div>
							</div>
							<?php if($cperiksa > 0){ ?>
							<div class='col-md-6'>
								<h5>Pemeriksaan UGD</h5>
								<table class='table table-bordered'>
									<tr>
										<th width=200 >Keluhan Utama</th>
										<td><?= $pemeriksaan->keluhanutama?></td>
									</tr>
									<tr>
										<th width=200 >Tindakan UGD</th>
										<td><?= $pemeriksaan->pecah($pemeriksaan->tindakan) ?></td>
									</tr>
									<tr>
										<th width=200 >Terapi / Obat</th>
										<td><?= $pemeriksaan->pecah($pemeriksaan->obat) ?></td>
									</tr>
									<tr>
										<th width=200 >Lab</th>
										<td><?= $pemeriksaan->pecah($pemeriksaan->lab) ?>
										<a><span class='badge bg-blue'>Lihat</span></a>
										</td>
									</tr>
									<tr>
										<th width=200 >Radiologi</th>
										<td><?= $pemeriksaan->pecah($pemeriksaan->radiologi) ?> <a><span class='badge bg-yellow'>Lihat</span></a></td>
									</tr>
								</table>
								<h5>Pemeriksaan Fisik </h5>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">TD</span>
									<input type='text' class='form-control' readonly value='<?= $pemeriksaan->td ?> mmHg'>	
									<span class="input-group-addon" id="basic-addon1">Nadi</span>
									<input type='text' class='form-control' readonly value='<?= $pemeriksaan->nadi ?> x/menit'>	
								</div>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Respirasi</span>
									<input type='text' class='form-control' readonly value='<?= $pemeriksaan->pernapasan ?> x/menit'>	
									<span class="input-group-addon" id="basic-addon1">Suhu</span>
									<input type='text' class='form-control' readonly value='<?= $pemeriksaan->suhu ?> C'>	
								</div>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Diagnosa</span>
									<input type='text' class='form-control' readonly value='<?= $pemeriksaan->diagnosa ?>'>	
								</div>
							</div>
							<?php } ?>
						</div>
						
                    </div>
                  </div>
                </div>

              </div>
				</div>
				<?php } ?>
			  </div>
			  <div class="tab-pane" id="tab_6-3">
			  
				<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],'id'=>'formSubmit']); ?>	
				 <?= $form->field($dranap, 'rm')->hiddeninput(['value'=>$model->no_rekmed])->label(false); ?> 
				 <?= $form->field($dranap, 'idrawat')->hiddeninput(['value'=>$model->idrawat])->label(false); ?> 
				 <?= $form->field($dranap, 'kat')->hiddeninput(['value'=>$model->id])->label(false); ?> 
				<?= $form->field($dranap, 'kadiagnosa')->widget(Select2::classname(), [
					'name' => 'kv-repo-template',
					'options' => ['placeholder' => 'Cari Diagnosa .....'],
					'pluginOptions' => [
					'allowClear' => true,
					'minimumInputLength' => 3,
					'ajax' => [
					'url' => "https://simrs.rsausulaiman.com/apites/listdiagnosa",
					'dataType' => 'json',
					'delay' => 250,
					'data' => new JsExpression('function(params) { return {q:params.term};}'),
					'processResults' => new JsExpression($resultsJs),
					'cache' => true
					],
					'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
					'templateResult' => new JsExpression('formatRepo'),
					'templateSelection' => new JsExpression('formatRepoSelection'),
					],
				])->label(false);?>
				 <?= $form->field($dranap, 'jenis')->dropDownList(ArrayHelper::map(Diagnosajenis::find()->all(), 'id', 'jenis'),['prompt'=>'- Jenis Diagnosa -'])?> 
				 <?= Html::submitButton('+', ['class' => 'btn btn-success']) ?>
				<?php ActiveForm::end(); ?>
				<br>
				<table class='table table-bordered'>
					<tr>
						<td>No</td>
						<td>Diagnosa</td>
						<td>Jenis Diagnosa</td>
						<td>#</td>
						
					</tr>
					<?php foreach($diag as $nosa): ?>
					<tr>
						<td><?= $no++?></td>
						<td><?= $nosa->kadiagnosa?></td>
						<td><?= $nosa->jenisdiag->jenis ?></td>
						<td><a href='<?= Url::to(['rawatinap/deletediag/'.$nosa->id]) ?>'><span class="label label-danger"><i class="fa fa-close"></i></span></a></td>
						
					</tr>
					<?php endforeach; ?>
				</table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3-2">
                 <a href='<?= Yii::$app->params['baseUrl'].'/dashboard/rawatinap/labinap/'.$model->id?>' class="btn btn-success btn-md">Laboratorium</a>
                 <a href='<?= Yii::$app->params['baseUrl'].'/dashboard/rawatjalan/lab/'.$model->id?>' class="btn btn-warning btn-md">Radiologi</a>
				  <a href='<?= Yii::$app->params['baseUrl'].'/dashboard/asesmen/igdrawat/'.$model->id?>' class="btn btn-info btn-md">Visit Dokter </a>
				  <a href='<?= Yii::$app->params['baseUrl'].'/dashboard/asesmen/igdrawat/'.$model->id?>' class="btn btn-primary btn-md">Pindah Ruangan </a>
				   <a href='<?= Yii::$app->params['baseUrl'].'/dashboard/asesmen/igdrawat/'.$model->id?>' class="btn btn-danger btn-md">Oprasi </a>
				  <?php if($model->idpoli == 5){?>
				  <a href='<?= Yii::$app->params['baseUrl'].'/dashboard/pasien/rawatinap/'.$model->pasien->id?>' class="btn btn-default btn-md">USG</a>
				  <?php }else{echo"";} ?>
				 
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
			</div>

		</div>
	</div>
</div>	