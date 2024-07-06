<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Tindakandokter;
use common\models\Resepdokter;
use common\models\Rawatjalan;
use common\models\Keluhan;
$keluhan = Keluhan::find()->where(['kode_p'=>$model->idrawat])->andwhere(['idtkp'=>2])->one();
$tindakan = Tindakandokter::find()->where(['kode_rawat'=>$model->idrawat])->groupBy(['DATE_FORMAT(tgl,"%Y-%m-%d")'])->all();
$resep = Resepdokter::find()->where(['idrawat'=>$model->idrawat])->groupBy(['DATE_FORMAT(tanggal,"%Y-%m-%d")'])->all();
$digd = Rawatjalan::find()->where(['idrawat'=>$model->idrawat])->andwhere(['idjenisrawat'=>3])->one();
$drj = Rawatjalan::find()->where(['idrawat'=>$model->idrawat])->andwhere(['idjenisrawat'=>2])->one();
?>

<div class='container-fluid'>
	<div class='row'>
		<div class='col-md-12'>
			<div class='box box-body'>
			<h5><?= $model->dokter->namadokter ?></h5>
			</div>
			<div class='box box-body'>
			<a href='<?= Yii::$app->params['baseUrl'].'/dashboard/rawatinap/keluarkamar/'.$model->id?>' class="btn btn-default btn-md">Pulang</a>
			</div>
			<div class='box box-body'>
				          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li><a href="#tab_1-1" data-toggle="tab">Tindakan Dokter</a></li>
              <li><a href="#tab_2-2" data-toggle="tab">Medikamentosa</a></li>
              <li><a href="#tab_3-2" data-toggle="tab">Tindak Lanjut</a></li>
			  <li  class="active"><a href="#tab_3-3" data-toggle="tab">Detail Pasien</a></li>
            
              <li class="pull-left header"><i class="fa fa-th"></i>  </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane " id="tab_1-1">
              <a href='<?= Yii::$app->params['baseUrl'].'/dashboard/rawatinap/createtindakan/'.$model->id?>' class="btn btn-success btn-md">+ Tindakan</a>
			  <div class='row'>
			  <div class='col-md-12'>
				<div class='box-body'>
				<?php foreach($tindakan as $t):?>
				<?php $tgl=date('Y-m-d',strtotime($t->tgl)); ?>
				<h4><?= date('d F Y',strtotime($t->tgl)) ?></h4>
					<?php $ttt= Tindakandokter::find()->where(['DATE_FORMAT(tgl,"%Y-%m-%d")'=>$tgl])->andwhere(['kode_rawat'=>$model->idrawat])->all();
					?>
					 
					<table class="table table-bordered">
					<tr>
						<th>Nama Tindakan</th>
						<th>Dokter Penanggung Jawab</th>
						<th>Jam Tindakan</th>
						<th>Tempat Tindakan</th>
					
					</tr>
				<?php foreach($ttt as $tr): ?>
					<tr>
						<td><?= $tr->tindakan->namatindakan ?></td>
						<td><?= $tr->dokter->namadokter ?></td>
						<td><?=date('G:i A',strtotime($tr->tgl))?></td>
						<?php if($tr->idtkp == 1 ){echo'<td>'.
						$tr->rawatja->polii->namapoli
						.'</td>';}else{echo'<td>'.$tr->jenis->jenisrawat.'</td>';} ?>
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
				<div class='row'>
				<div class='col-md-4 col-xs-12'>
					<h6 style='color:grey;'>Nama Pasien</h6>
					<h5> <?= $model->pasien->sbb?>. <?= $model->pasien->nama_pasien ?></h5><hr>
					<h6 style='color:grey;'>RM</h6>
					<h5><?= $model->no_rekmed ?></h5><hr>
					<h6 style='color:grey;'>Tanggal Lahir</h6>
					<h5><?= $model->pasien->tanggal_lahir ?></h5><hr>
					<h6 style='color:grey;'>Usia</h6>
					<h5><?= $model->pasien->usia ?> th</h5><hr>
					<h6 style='color:grey;'>Jenis Kelamin</h6>
					<h5><?= $model->pasien->jenis_kelamin ?></h5><hr>
					<h6 style='color:grey;'>Gol Darah</h6>
					<h5><?= $model->pasien->gol_darah ?></h5><hr>
					<h6 style='color:grey;'>Diagnosa </h6>
					<h5><?= $digd->kdiagnosa ?></h5>
				</div>
				<div class='col-md-8'>
					
					<table>
					<tr>
						<td width="150">Diagnosa Awal</td>
						<td width="20"> : </td>
						<td> <?= $digd->kdiagnosa ?></td>
					</tr>
					 <br>
					<?php if($model->kdiagnosa != null){ ?>
						<div class='box box-body'>
						<h5>Asesmen Pasien</h5><hr>
						<h6>Keluhan</h6>
						<p><?= $keluhan->keluhan  ?></p><hr>
						<h6>Riwayat Penyakit</h6>
						<p><?= $keluhan->rwt_penyakits  ?></p>
					</div>
						<tr>
						<td>Diagnosa Sekarang</td>
						<td> : </td>
						<td> <?= $model->kdiagnosa ?></td>
					</tr>
						
					<?php }else{ ?>
						 <a href='<?= Yii::$app->params['baseUrl'].'/dashboard/asesmen/awalranap/'.$model->id?>' class="btn btn-success btn-md">Periksa</a>
					<?php } ?>
				</table>
				</div>
				</div>
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