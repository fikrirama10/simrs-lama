<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Tindakandokter;
use common\models\Resepdokter;
use common\models\Lab;
use common\models\Pemriklab;
/* @var $this yii\web\View */
/* @var $model common\models\Rawatjalan */
$tindakan = Tindakandokter::find()->where(['kode_rawat'=>$model->idrawat])->all();
$resep = Resepdokter::find()->where(['idrawat'=>$model->idrawat])->all();
$lab = Pemriklab::find()->where(['idrawat'=> $model->idrawat])->all();
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rawatjalans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rawatjalan-view">
	<div class='container-fluid' style='margin-top:20px;'>
		<div class='box box-body'>
			<h4><?= $model->pasien->sbb ?>, <?= $model->pasien->nama_pasien?> ( <?= $model->pasien->jenis_kelamin?> )<a class='pull-right'>Diagnosis : <?= $model->kdiagnosa ?></a></h4>
			<a style='color:grey;'>RM: <?= $model->no_rekmed ?> <b>|</b> No Rawat: <?= $model->idrawat?></a>
			<h6><?= $model->pasien->tempat_lahir?>, <?= date('d F Y',strtotime($model->pasien->tanggal_lahir)) ?> ,<?=$model->pasien->usia?> th</h6>
			<hr>
			<a style='color:grey;'><?= $model->pasien->alamat?></a><br>
			<a style='color:grey;'><?= $model->pasien->nohp?></a><br>
		</div>
		<div class='box box-body'>
			<h5><?php 
			if($model->idjenisrawat == 1){
				echo $model->jerawat->jenisrawat .' , '. $model->polii->namapoli;
				}
				else if($model->idjenisrawat == 2){
					echo $model->jerawat->jenisrawat .', kelas'. $model->idkelas;
					}else{
						echo $model->jerawat->jenisrawat;
						} 
							?><a class='pull-right' style='color:grey;'><?= $model->tgldaftar ?></a></h5><hr>
					<h6>a. Tindakan Dokter</h6>
					<table  class="table table-bordered table-responsive-xs">
					<tr>
						<th>Nama Tindakan</th>
						<th>Dokter Penanggung Jawab</th>
						<th>Jam Tindakan</th>
						<th>Jumlah Tindakan</th>
					
					</tr>
				<?php foreach($tindakan as $tr): ?>
					<tr>
						<td><?= $tr->tindakann ?></td>
						<td><?= $tr->dokter->namadokter ?></td>
						<td><?=date('G:i A',strtotime($tr->tgl))?></td>
						<td>1 Kali</td>
					</tr>
				<?php endforeach; ?>
				
				</table><hr>
				<h6>b. Resep Dokter</h6>
				<table  class="table table-bordered">
					<tr>
						<th>Nama Obat</th>
						<th>Jumlah Obat</th>
						<th>Dosis</th>
						<th>Ket</th>
						<th>jam</th>
					
					</tr>
				<?php foreach($resep as $rr): ?>
					<tr>
						<td><?= $rr->nobat->namaobat ?></td>
						<td><?= $rr->jumlah ?></td>
						<td><?= $rr->dosis ?></td>
						<td><?= $rr->ket ?></td>
						<td><?= date('G:i A',strtotime($rr->tanggal)) ?></td>
					</tr>
				<?php endforeach; ?>
				</table><hr>
					<h6>c. Tindak Lanjut Laboratorium</h6>
					<table class="table table-bordered">
					<tr>
						<th>Jenis Pemeriksaan</th>
						<th>Tindakan</th>
						<th>Hasil</th>
						<th>Nilai Rujukan</th>
						<th>Satuan</th>
						
					
					</tr>
					<?php foreach($lab as $hhh): ?>
					<tr>
						<td><b><?= $hhh->katt->nama?></b></td>
						<td><?= $hhh->kat->nama ?></td>
						<td><?= $hhh->hasil ?></td>
						<?php if($hhh->pasien->jenis_kelamin == 'L'){
				    		echo"<td>".$hhh->kat->l."</td>";
				    	}else{
				    		echo"<td>".$hhh->kat->p."</td>";
				    	} ?>
						<td><?= $hhh->kat->satuan ?></td>
					</tr>
					<?php endforeach; ?>
					</table><br>
						
				
		</div>
	</div>
</div>
