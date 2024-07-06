<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Tindakandokter;
use common\models\Resepdokter;
use common\models\Lab;
use common\models\Pemriklab;
use common\models\Orderlab;
use common\models\Diagnosaranap;
use common\models\PemeriksaanIgd;
use common\models\Transaksi;
use common\models\Trandetail;
use common\models\PemeriksaanRajal;
if($model->idjenisrawat == 1){
$pemeriksaan = PemeriksaanRajal::find()->where(['idrawat'=>$model->id])->one();
}else{
$pemeriksaan = PemeriksaanIgd::find()->where(['idrawat'=>$model->id])->one();
}
$transaksi = Transaksi::find()->where(['idrawat'=>$model->id])->one();
$no = 1;
$diag = Diagnosaranap::find()->where(['idrawat'=>$model->idrawat])->all();
/* @var $this yii\web\View */
/* @var $model common\models\Rawatjalan */

$tindakan = Tindakandokter::find()->where(['kode_rawat'=>$model->idrawat])->all();
$resep = Resepdokter::find()->where(['idrawat'=>$model->idrawat])->all();
$lab = Orderlab::find()->where(['idrawat'=> $model->idrawat])->andWhere(['idtkp'=>$model->idjenisrawat])->all();
$labc = Orderlab::find()->where(['idrawat'=> $model->idrawat])->andWhere(['idtkp'=>$model->idjenisrawat])->count();
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rawatjalans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rawatjalan-view">
					
						
						<br>
						
	<div class='container-fluid' style='margin-top:20px;'>
	
		<div class='box box-body'>

			<h4><?= $model->pasien->sbb ?>, <?= $model->pasien->nama_pasien?> ( <?= $model->pasien->jenis_kelamin?> )
			<?php if($model->idjenisrawat == 2){echo"";}else{?><a class='pull-right'>Diagnosis : <?= $model->kdiagnosa ?></a><?php } ?></h4>
			<a style='color:grey;'>RM: <?= $model->no_rekmed ?> <b>|</b> No Rawat: <?= $model->idrawat?> | Jenis Bayar : <?= $model->carabayar->jenisbayar ?> | Waktu : <?= $model->tgldaftar ?></a>
			<h6><?= $model->pasien->tempat_lahir?>, <?= date('d F Y',strtotime($model->pasien->tanggal_lahir)) ?> ,<?=$model->pasien->usia?> th</h6>
			<hr>
			<a style='color:grey;'><?= $model->pasien->alamat?></a><br>
			<a style='color:grey;'><?= $model->pasien->nohp?></a><br>
		</div>
		
		
		<?php if($pemeriksaan){ ?>
		<?php if($model->idjenisrawat == 3){ ?>
		<div class ='box box-body'>
			<div class='row'>
				<div class='col-md-6'>
								<h5>Pemeriksaan</h5>
								<table class='table table-bordered'>
									<tr>
										<th width=200 >Keluhan Utama</th>
										<td><?= $pemeriksaan->keluhanutama?></td>
									</tr>
									<tr>
										<th width=200 >Riwayat Penyakit</th>
										<td><?= $pemeriksaan->rwpenyakit?></td>
									</tr>
									<tr>
										<th width=200 >Triage</th>
										<td>
										<?php 
												if($pemeriksaan->triase == 1){echo" <span class='badge bg-red'>Kategori 1</span>";}
												else if($pemeriksaan->triase == 2){echo" <span class='badge bg-red'>Kategori 2</span>";}
												else if($pemeriksaan->triase == 3){echo" <span class='badge bg-yellow'>Kategori 3</span>";}
												else if($pemeriksaan->triase == 4){echo" <span class='badge bg-green'>Kategori 4</span>";}
											?>
										</td>
									</tr>
									<tr>
										<th width=200 >Kesadaran</th>
										<td><?= $pemeriksaan->kesadaran->kesadaran ?></td>
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
										
										</td>
									</tr>
									<tr>
										<th width=200 >Radiologi</th>
										<td><?= $pemeriksaan->pecah($pemeriksaan->radiologi) ?> </td>
									</tr>
								</table>
								<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Diagnosa</span>
						<input type='text' class='form-control' readonly value='<?= $model->kdiagnosa ?>'>
				</div>
								
				</div>
				<div class='col-md-6'>
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
									<span class="input-group-addon" id="basic-addon1">Diagnosis</span>
									<input type='text' class='form-control' readonly value='<?= $pemeriksaan->diagnosa ?>'>	
								</div>
								<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Kepala</span>
					<textarea type='text' class='form-control' readonly><?= $pemeriksaan->ku_kepala ?></textarea>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Leher</span>
					<textarea type='text' class='form-control' readonly><?= $pemeriksaan->ku_leher ?></textarea>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Paru paru</span>
					<textarea type='text' class='form-control' readonly><?= $pemeriksaan->ku_tparu ?></textarea>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Jantung</span>
					<textarea type='text' class='form-control' readonly><?= $pemeriksaan->ku_tjantung ?></textarea>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Abdomen</span>
					<textarea type='text' class='form-control' readonly><?= $pemeriksaan->abdomen ?></textarea>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Kulit</span>
					<textarea type='text' class='form-control' readonly><?= $pemeriksaan->kulit ?></textarea>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Extremitas</span>
					<textarea type='text' class='form-control' readonly><?= $pemeriksaan->extremitas ?></textarea>
				</div>
			</div>
			</div>
		</div>
		<?php }else if($model->idjenisrawat == 1){ ?>
		<div class ='box box-body'>
			<div class='row'>
				<div class='col-md-6'>
								<h5>Pemeriksaan</h5>
								<table class='table table-bordered'>
									<tr>
										<th width=200 >Pemeriksaan Dokter</th>
										<td><?= $pemeriksaan->pemeriksaan ?></td>
									</tr>
									<tr>
										<th width=200 >Tindakan Dokter</th>
										<td><?= $pemeriksaan->tindakandokter ?> ,<br><?= $pemeriksaan->pecah($pemeriksaan->tindakan) ?></td>
									</tr>
									<tr>
										<th width=200 >Terapi / Obat</th>
										<td><?= $pemeriksaan->pecah($pemeriksaan->obat) ?>
										</td>
									</tr>
									<tr>
										<th width=200 >Dosis Obat</th>
										<td><?= $pemeriksaan->resepobat ?>
										</td>
									</tr>
									<tr>
										<th width=200 >Lab</th>
										<td><?= $pemeriksaan->pecah($pemeriksaan->lab) ?>
										
										</td>
									</tr>
									<tr>
										<th width=200 >Radiologi</th>
										<td><?= $pemeriksaan->pecah($pemeriksaan->radiologi) ?> </td>
									</tr>
								</table>
								<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Diagnosa</span>
						<input type='text' class='form-control' readonly value='<?= $model->kdiagnosa ?>'>
				</div>
								
				</div>
				<div class='col-md-6'>
				<h5>Pemeriksaan Fisik </h5>
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1">TD</span>
							<input type='text' class='form-control' readonly value='<?= $pemeriksaan->td ?> mmHg'>	
							<span class="input-group-addon" id="basic-addon1">Nadi</span>
							<input type='text' class='form-control' readonly value='<?= $pemeriksaan->nadi ?> x/menit'>	
						</div>
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1">Respirasi</span>
							<input type='text' class='form-control' readonly value='<?= $pemeriksaan->respirasi ?> x/menit'>	
							<span class="input-group-addon" id="basic-addon1">Suhu</span>
							<input type='text' class='form-control' readonly value='<?= $pemeriksaan->suhu ?> C'>	
						</div>
						
							
			</div>
			</div>
		</div>
		<?php } ?>
		<?php }?>
		<div class='box'>
		<?php $no=1; if($transaksi){ ?>
		<div class='box-header'><h4>Rincian Transaksi</h4><br>
		<a style='color:grey;'>Transaksi Id: <?= $transaksi->idtrx?></a><br>
		<a style='color:grey;'>Tgl Transaksi: <?= $transaksi->tglbayar?></a><br>
		</div>				
		
		<div class='box-body'>		
		<table class='table table-bordered'>
			<tr>
				<th>No</th>
				<th>Nama Tindakan / Tarif</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Total</th>
			</tr>
		<?php 
		$trandetail = Trandetail::find()->where(['idtrx'=>$transaksi->idtrx])->all();
		foreach($trandetail as $td): ?>
			<tr>
				<td><?= $no++ ?></td>
				<td><?= $td->tindakan->nama ?></td>
				<td align=right>Rp. <?= Yii::$app->algo->IndoCurr($td->harga)?></td>
				<td><?= $td->jumlah ?> Kali</td>
				<td align=right>Rp. <?= Yii::$app->algo->IndoCurr($td->total)?></td>
			</tr>
		<?php endforeach;  ?>
			<tr>
				<td align=right colspan ='4'>SubTotal</td>
				<td align=right>Rp. <?= Yii::$app->algo->IndoCurr($transaksi->total)?></td>
			</tr>
		</table>
	
		</div>
		<?php } ?>
		</div>
		<div class='box box-body'>
			<?php if($labc > 0){ ?>
				<?php foreach($lab as $l): ?>
				<?= $l->kodelab?>
				<?php endforeach; ?>
			<?php } ?>
		</div>
	</div>
</div>
