<?php 
use yii\helpers\Html;
use Picqer\Barcode\BarcodeGeneratorHTML;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
?>
<div class='headerrad'>
	<div class='logorad'>
	<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/hitput.png',['class' => 'img img-responsive']);?>
	</div>
	<div class='unitrad'><b>UNIT RADIOLOGI <br> RSAU dr.NORMAN T.LUBIS</b></div>
	<div class='drtyh'><p class='kepada'>Kepada</p><p class='yth'>Yth <?= $pemriklab->rad->dokter->namadokter?></p><p class='kepada'>Ditempat</p></div>
	

</div>
<div class='orad'>
	<table>
		<tr>
			<td>No RM</td>
			<td>:</td>
			<td><?= $pemriklab->rad->pasien->no_rekmed ?></td>
			<td></td>
			<td>No Foto</td>
			<td>:</td>
			<td><?= $pemriklab->nofoto?></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><?= $pemriklab->rad->pasien->sbb ?>.<?= $pemriklab->rad->pasien->nama_pasien ?></td>
			<td></td>
			<td>Pemeriksaan</td>
			<td>:</td>
			<td><?= $pemriklab->drad->jenispemeriksaan ?></td>
		</tr>
		<tr>
			<td>Tgl Lahir</td>
			<td>:</td>
			<td><?= date('d-m-Y',strtotime($pemriklab->rad->pasien->tanggal_lahir)) ?> ( <?= $pemriklab->rad->pasien->usia ?> th )</td>
			<td></td>
			<td>Alamat</td>
			<td>:</td>
			<td><?= $pemriklab->rad->pasien->alamat?></td>
		</tr>
		<tr>
			<td>Tgl Pemeriksaan</td>
			<td>:</td>
			<td><?= date('Y-m-d',strtotime($pemriklab->waktu)) ?></td>
		</tr>
	</table>
</div>	
<center><h4>Hasil Pemeriksaan Radiologi</h4></center>
Klinis :
<div class='harad'>
	<b> <?= $pemriklab->klinis ?></b>
</div><br>
Hasil :
<div class='harad'>
	<p> <?= nl2br (stripslashes ($pemriklab->hasil)); ?></p>
</div><br>
Kesan :
<div class='harad'>
	<b> <?= nl2br (stripslashes ($pemriklab->kesan)); ?></b>
</div><br>
<div class='drdevi'>
	Yang Memeriksa<br>Dokter Unit Radiologi
	<br>
	<br>
	<br>
	<br>
	<?php // Html::img(Yii::$app->params['baseUrl'].'/frontend/images/drdevi.png',['class' => 'img img-responsive']);?>
	dr Deviasari Sp.Rad
	</div>
