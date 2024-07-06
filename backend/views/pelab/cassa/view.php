
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use common\models\Tindakandokter;
use common\models\Resepdokter;
use common\models\Rawatjalan;
use common\models\Lab;
$rawatjalan = Rawatjalan::find()->where(['idrawat'=>$model->idrawat])->all();
$rc = Rawatjalan::find()->where(['idrawat'=>$model->idrawat])->count();

?>
<div class='container-fluid' style='background: #;'>
	<div class='row'>

		<div class='col-md-12'>
			<div class='box box-body'>
			<h5>RSAU LANUD SULAIMAN</h5>
				<h6>Jalan Terusan Kopo No 500 , Telp (022) 5409608</h6><hr>
			</div>
		</div>
	</div>
<?php foreach($rawatjalan as $rj): ?>

<?php 
		$sum = 0;
		$tindakan = Tindakandokter::find()->where(['kode_rawat'=>$model->idrawat])->andwhere(['idtkp'=>$rj->idjenisrawat])->all();
		$labb = Lab::find()->where(['idrawat'=>$model->idrawat])->andwhere(['status'=>1])->andwhere(['idtkp'=>$rj->idjenisrawat])->all();
		$resep = Resepdokter::find()->where(['idrawat'=>$model->idrawat])->andwhere(['idtkp'=>$rj->idjenisrawat])->all(); 
		foreach($tindakan as $k)
		{
		   $sum+= $k->tindakan->tarif;
		}
		$summ = 0;
		foreach($resep as $r)
		{
		   $summ+= $r->nobat->harga * $r->jumlah ;
		}

		$sum2 = 0;
		$tindaka = Tindakandokter::find()->where(['kode_rawat'=>$model->idrawat])->all();
		$rese = Resepdokter::find()->where(['idrawat'=>$model->idrawat])->all(); 
		$labsum = 0;
		$labora = Lab::find()->where(['idrawat'=>$model->idrawat])->andwhere(['status'=>1])->all();
		foreach($tindaka as $ki)
		{
		   $sum2+= $ki->tindakan->tarif;
		}
		$summ3 = 0;
		foreach($rese as $ri)
		{
		   $summ3+= $ri->nobat->harga * $ri->jumlah ;
		}
		foreach($labora as $la)
		{
		   $labsum+= $la->katlab->harga ;
		}
		$masuk = date('Y-m-d',strtotime($rj->tglmasuk));
		 $ihi = date('Y-m-d',strtotime($rj->tglkeluar));
		 $diff =strtotime($ihi)-strtotime($masuk); 
		 $hari = floor($diff/86400);
		
		 


?>

<div class='box box-danger collapsed-box'>
	 <div class="box-header with-border">
              <h3 class="box-title"><?= $rj->jerawat->jenisrawat ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
 <div class="box-body">
<?php if($rj->idjenisrawat == 2){

 ?>
		<div class='row'>
		<div class='col-md-12'>
			Kamar
		</div>
		<div class='col-md-12' >
			<table class='table table-bordered'>
					<tr>
						<th>Nama Ruangan</th>
						<th>Tanggal Masuk</th>
						<th>Tanggal Pulang</th>
						<th>Lamanya</th>
						<th>Tarif / Hari</th>
					</tr>
					<tr>
						<td><?= $rj->kamar->namaruangan?> <?= $rj->kelas->namakelas?></td>
						<td><?= $rj->tglmasuk ?></td>
						<td><?= $rj->tglkeluar ?></td>
						<td><?= $hari ?> hari</td>
						<td>Rp. <?= Yii::$app->formatter->asDecimal($rj->kelas->tarif_hari) ?></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>TOTAL Bayar (RP)</td>
						<td>Rp. <?=  Yii::$app->formatter->asDecimal($hari*$rj->kelas->tarif_hari)  ?></td>
					</tr>
			</table>
			
			
		
		</div>
		</div>

<?php } ?>

	<div class='row'>
		<div class='col-md-12'>
		Tindakan
		</div>
		<div class='col-md-12' >
			<table class='table table-bordered'>
					<tr>
						<th>Tanggal</th>
						<th>Tindakan</th>
						<th>Dokter</th>
						<th>Tarif</th>
					</tr>
					<?php foreach($tindakan as $t): ?>
					<tr>
						<td><?= $t->rawatja->tgldaftar?></td>
						<?php if($rj->idbayar == 4){
							echo'<td>'.$t->tindakan->namatindakan.'</td>';
						}else{echo'<td>'.$t->tindakann.'</td>';} ?>
						<td><?= $t->dokter->namadokter?></td>
						<td>Rp. <?= Yii::$app->formatter->asDecimal($t->tindakan->tarif)?></td>
					</tr>
					<?php endforeach; ?>
					<tr>
						<td></td>
						<td></td>
						<td>TOTAL TINDAKAN (RP)</td>
						<td>Rp. <?= Yii::$app->formatter->asDecimal($sum)?></td>
					</tr>
			</table>

			
			
		
		</div>

	

	</div>
		<div class='row'>
		<div class='col-md-12'>
		Obat
		</div>
		
		<div class='col-md-12' >
			<table class='table table-bordered'>
					<tr>
						<th>Kode Obat</th>
						<th>Nama Obat</th>
						<th>Harga</th>
						<th>Jumlah</th>
					</tr>
					<?php foreach($resep as $r): ?>
					<tr>
						<td><?= $r->kodeobat?></td>
						<td><?= $r->nobat->namaobat ?></td>
						<td><?=  Yii::$app->formatter->asDecimal($r->nobat->harga) ?></td>
						<td><?= $r->jumlah?></td>
						
					</tr>
					<?php endforeach; ?>
					<tr>
						<td></td>
						<td></td>
						<td>TOTAL OBAT (RP)</td>
						<td>Rp. <?=  Yii::$app->formatter->asDecimal($summ)?></td>
					</tr>
			</table>
			
		</div>
	</div>
	<?php $pasien=Lab::find()->where(['idrawat'=>$model->idrawat])->all(); 
	if($pasien == null){echo"";}else{
	?>

	<div class='row'>
		<div class='col-md-12'>
			Lab
		</div>
		<div class='col-md-12' >
			<table class='table table-bordered'>
					<tr>
						<th>Pemeriksaan</th>
						<th>Tkp</th>
						<th>Tanggal Pemeriksaan</th>
						<th>Tarif Pemeriksaan</th>
					</tr>
					<?php foreach ($labb as $lab): ?>
						<tr>
						<td><?= $lab->katlab->nama?></td>
						<td><?= $lab->idtkp ?></td>
						<td><?= $lab->tgl_peniksa ?></td>
						<td>Rp. <?= $lab->katlab->harga ?></td>
						</tr>
					<?php endforeach; ?>
					
					
			</table>
			
			
		
		</div>
		</div>

<?php } if($rj->idkelas == null){echo  Yii::$app->formatter->asDecimal($sum+$summ+$labsum);}else{ ?>
<div class='col-md-8'>
Total<?=  Yii::$app->formatter->asDecimal($sum + $summ + $hari * $rj->kelas->tarif_hari + $labsum)?>
</div>
<?php } ?>
</div>
</div>
<?php endforeach; ?>
	<div class='row'>
	<div class='col-md-12'>
			<div class='box box-body'>
				<h4><?= $model->pasien->sbb ?>, <?= $model->pasien->nama_pasien?> ( <?= $model->pasien->jenis_kelamin?> )</h4>
			<a style='color:grey;'>RM: <?= $model->no_rekmed ?> <b>|</b> No Rawat: <?= $model->idrawat?></a>
			<h6><?= $model->pasien->tempat_lahir?>, <?= date('d F Y',strtotime($model->pasien->tanggal_lahir)) ?> ,<?=$model->pasien->usia?> th</h6>
			<a style='color:grey;'><?= $model->pasien->alamat?></a><br>
			<a style='color:grey;'><?= $model->pasien->nohp?></a><br>
			<hr>
			
				
				<h4>INVOICE<a class='btn btn-warning btn-xs pull-right' href="">Print</a></h4>
				<?php if($rj->idkelas == null){echo  '<h5>Total : Rp.'.Yii::$app->formatter->asDecimal($sum2+$summ3+$labsum).'</h5>';}else{ ?>
				<h5>Total : Rp. <?= Yii::$app->formatter->asDecimal($sum2 + $summ3 + $hari * $rj->kelas->tarif_hari + $labsum) ?></h5>
			<?php } ?>
			</div>

		</div>
	</div>