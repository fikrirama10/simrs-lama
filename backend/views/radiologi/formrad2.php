<?php 
use yii\helpers\Html;
use Picqer\Barcode\BarcodeGeneratorHTML;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
?>
<div class='headerrad'>
	<div class='logorad'>
	<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/download.png',['class' => 'img img-responsive']);?>
	</div>
	<div class='unitrad'><b>UNIT RADIOLOGI <br> RSAU dr.NORMAN T.LUBIS</b></div>
	<div class='drtyh'><p class='kepada'>Kepada</p><p class='yth'>Yth <?= $model->dokter->namadokter?></p><p class='kepada'>Ditempat</p></div>
	

</div>
<div class='orad'>
	<table>
		<tr>
			<td>No RM</td>
			<td>:</td>
			<td><?= $model->pasien->no_rekmed ?></td>
			<td></td>
			<td>Tgl Lahir</td>
			<td>:</td>
			<td><?= date('d-m-Y',strtotime($model->pasien->tanggal_lahir)) ?></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><?= $model->pasien->sbb ?>.<?= $model->pasien->nama_pasien ?></td>
			<td></td>
			<td>Alamat</td>
			<td>:</td>
			<td><?= $model->pasien->alamat?></td>
		</tr>
		<tr>
			<td>Tgl Lahir</td>
			<td>:</td>
			<td><?= date('d-m-Y',strtotime($model->pasien->tanggal_lahir)) ?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
</div>
<?php foreach($periklab as $prlb): ?>	
<center><h4>Hasil Pemeriksaan Radiologi</h4></center>
No Foto :
<div class='harad'>
	<b> <?= $prlb->nofoto ?></b>
</div><br>
Pemeriksaan :
<div class='harad'>
	<b> <?= $prlb->drad->jenispemeriksaan ?></b>
</div><br>
Klinis :
<div class='harad'>
	<b> <?= $prlb->klinis ?></b>
</div><br>
Hasil :
<div class='harad'>
	<p> <?= nl2br (stripslashes ($prlb->hasil)); ?></p>
</div><br>
Kesan :
<div class='harad'>
	<b> <?= nl2br (stripslashes ($prlb->kesan)); ?></b>
</div><br>
<?php endforeach ; ?>
<br>

<div class='drdevi'>
	Yang Memeriksa<br>Dokter Unit Radiologi
	<br>
	<br>
	<br>
	<br>

	<?php // Html::img(Yii::$app->params['baseUrl'].'/frontend/images/drdevi.png',['class' => 'img img-responsive']);?>
	dr Deviasari Sp.Rad
	</div>
