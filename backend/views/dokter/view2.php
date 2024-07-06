<?php
	use common\models\Jadwaldokter;
	use common\models\KuotaPasien;
	use yii\helpers\Url;
	$no = 1;
	$jadwal = Jadwaldokter::find()->where(['iddokter'=>$model->id])->all();
	
?>
<div class='box'>
	<div class='box-header with-border'>
		<h3><?= $model->namadokter ?></h3>
		<h5><?= $model->poli->namapoli ?></h5>
	</div>
	<div class='box-body'>
		<table class='table table-hovered'>
			<tr>
				<th>No</th>
				<th>Hari</th>
				<th>Kuota</th>
				<th>#</th>
			</tr>
			<?php foreach($jadwal as $jd){ 
				$kuota = KuotaPasien::find()->where(['idhari'=>$jd->idhari])->andwhere(['iddokter'=>$model->id])->andwhere(['tgl'=>date('Y-m-d')])->count();
			?>
			<tr>
				<td><?= $no++ ?></td>
				<td><?= $jd->hari->nama_hari?></td>
				<td><?= $jd->kuota ?></td>
				<?php if($kuota < 1){ ?>
				<td><a href='<?= Url::to(['jadwaldokter/update/'.$jd->id])?>' class='btn btn-success'>Edit</a></td>
				<?php }else{echo'<td>Sudah ada pasien terdaftar di hari '.$jd->hari->nama_hari.' tanggal '.date('d/m/Y').'</td>';} ?>
			</tr>
			<?php } ?>
		</table>
	</div>
</div>