<?php
$url = 'http://192.168.1.26/simrs/api/icd10jd';
        $content = file_get_contents($url);
        $json = json_decode($content, true);
$url2 = 'http://192.168.1.26/simrs/api/icd10anakjd';
        $ank = file_get_contents($url2);
        $json2 = json_decode($ank, true);
$url3 = 'http://192.168.1.26/simrs/api/icd10bedahjd';
        $bdh = file_get_contents($url3);
        $json3 = json_decode($bdh, true);
$url4 ='http://192.168.1.26/simrs/api/klpcm';
		$klpcm = file_get_contents($url4);
        $json4 = json_decode($klpcm,true);

	$noa=1;
	$nob=1;
	$noc=1;
	$nod=1;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Diagnosaranap;
use common\models\Rawatjalan;
$dranap = Diagnosaranap::find()->joinWith(['pasien as ps'])->joinWith(['rawatja as rj'])->where(['between','tgldaftar','2019-01-01 23:59:59','2019-12-31 00:00:00'])->andwhere(['rj.idjenisrawat'=>2])->andwhere(['kadiagnosa'=>'A91 - Dengue hemorrhagic fever'])->andwhere(['between','rj.usia',1,16])->andwhere(['rj.status'=>7])->all();
$drj = Rawatjalan::find()->joinWith(['pasien as ps'])->where(['idjenisrawat'=>2])->andWhere(['between','ps.usia',1,16])->andwhere(['between','tgldaftar','2019-01-01 23:59:59','2019-12-31 00:00:00'])->andwhere(['status'=>7])->all();
$no =1;
$noq =1;
?>
<center><h2>Demografi Pasien 10 diagnosa terbanyak</h2></center>
<div class='hea0 olab'>
<div class='hea1'>
<h3>Berdasarkan Diagnosa 10 terbesar </h3>
<?php

$result =array_count_values($json4);
print_r ($result);
?>
<table class='table table-bordered'>
	<tr>
		<th>No</th>
		<th>Diagnosa</th>
		<th>Jumlah</th>
	</tr>
	
	<?php for($a=0; $a < 10; $a++){ ?>
		<tr>
		<td><?= $noa++ ?></td>
		<td><?= $json[$a]['Diagnosa'] ?></td>
		<td><?= $json[$a]['Jumlah'] ?></td>
		</tr>
	<?php } ?>
</table>
</div>
<div class='hea1'>
<h3>Berdasarkan Diagnosa 10 terbesar Anak </h3>
<table class='table table-bordered'>
	<tr>
		<th>No</th>
		<th>Diagnosa</th>
		<th>Jumlah</th>
	</tr>
	
	<?php for($a=0; $a < 10; $a++){ ?>
		<tr>
		<td><?= $nob++ ?></td>
		<td><?= $json2[$a]['Diagnosa'] ?></td>
		<td><?= $json2[$a]['Jumlah'] ?></td>
		</tr>
	<?php } ?>
</table>
</div>
<div class='hea1'>
<h3>Berdasarkan Diagnosa 10 terbesar Bedah </h3>
<table class='table table-bordered'>
	<tr>
		<th>No</th>
		<th>Diagnosa</th>
		<th>Jumlah</th>
	</tr>
	
	<?php for($a=0; $a < 10; $a++){ ?>
		<tr>
		<td><?= $noc++ ?></td>
		<td><?= $json3[$a]['Diagnosa'] ?></td>
		<td><?= $json3[$a]['Jumlah'] ?></td>
		</tr>
	<?php } ?>
</table>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</div>
<h2>DHF</h2>
<table border=1>
	<tr>
		<th>No</th>
		<th>Nama</th>
		<th>No Rekmed</th>
		<th>Usia</th>
		<th>Diagnosa</th>
		<th>Tanggal Masuk</th>
		<th>Tanggal Keluar</th>
		<th>Ruangan</th>
		<th>Lama Rawat</th>
	</tr>
	<?php foreach($drj as $rj): ?>
	<?php $ranap = Diagnosaranap::find()->where(['idrawat'=>$rj->idrawat])->andwhere(['kadiagnosa'=>'A91 - Dengue hemorrhagic fever'])->all() ;?>
		<?php foreach($ranap as $rp): ?>
			<tr>
				<td><?= $no++ ?></td>
				<td><?= $rp->pasien->nama_pasien?></td>
				<td><?= $rp->rm?></td>
				<td><?= $rp->pasien->usia?> th</td>
				<td><?= $rp->kadiagnosa?></td>
				<td>
			<?php	
			
					$lamarawat = strtotime($rj->tglkeluar) - strtotime($rj->tglmasuk);
					$ml = floor($lamarawat/86400) + 1; ?>
				<?= date('Y-m-d',strtotime($rj->tglmasuk))?></td>
				<td><?= $rj->tglkeluar?></td>
				<td><?= $rj->kamar->namaruangan?></td>
				<td><?= ($ml +1)?></td>
			</tr>
		<?php endforeach; ?>
	<?php endforeach; ?>
</table>
<h2>GEA</h2>
<table border=1>
	<tr>
		<th>No</th>
		<th>Nama</th>
		<th>No Rekmed</th>
		<th>Usia</th>
		<th>Diagnosa</th>
		<th>Tanggal Masuk</th>
		<th>Tanggal Keluar</th>
		<th>Ruangan</th>
		<th>Lama Rawat</th>
	</tr>
	<?php foreach($drj as $rj): ?>
	<?php $ranap = Diagnosaranap::find()->where(['idrawat'=>$rj->idrawat])->andwhere(['between','kadiagnosa','A09 - Diarrhoea and gastroenteritis of presumed infectious origin','A49 - Bacterial infection of unspecified site'])->all() ;?>
		<?php foreach($ranap as $rp): ?>
			<tr>
				<td><?= $noq++ ?></td>
				<td><?= $rp->pasien->nama_pasien?></td>
				<td><?= $rp->rm?></td>
				<td><?= $rp->pasien->usia?> th</td>
				<td><?= $rp->kadiagnosa?></td>
				<td>
			<?php	
			
					$lamarawat = strtotime($rj->tglkeluar) - strtotime($rj->tglmasuk);
					$ml = floor($lamarawat/86400) + 1; ?>
				<?= date('Y-m-d',strtotime($rj->tglmasuk))?></td>
				<td><?= $rj->tglkeluar?></td>
				<td><?= $rj->kamar->namaruangan?></td>
				<td><?= ($ml +1)?></td>
			</tr>
		<?php endforeach; ?>
	<?php endforeach; ?>
</table>