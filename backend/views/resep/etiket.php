<?php 
use yii\helpers\Html;
use Picqer\Barcode\BarcodeGeneratorHTML;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
?>
<?php foreach($resep as $resep): ?>
<div class='logo'><?= Html::img(Yii::$app->params['baseUrl2'].'/frontend/images/hitput.png',['class' => 'img img-responsive']);?></div>
<div class='header2'><div class='h6'>INSTALASI FARMASI RSAU SULAIMAN</div> <div class='h7'><i>Jl Terusan Kopo KM 10 no 457 Kab Bandung</i></div> <div class='h7'><i>Telepon (022) 5409608</i></div></div>
<hr>
<div class='identitas'>
	<div class='nama1'>No</div>
	<div class='namaa'>:11</div>
	<div class='nama1'>Tgl</div>
	<div class='norm'>:<?= date('d/m/Y',strtotime($resep->tanggal))?></div>
	<div class='nama1'>Nama</div>
	<div class='namaa'>: <?= $model->pasien->sbb ?>.<?= $model->pasien->nama_pasien ?></div>
	<div class='nama1'></div>
	<div class='nama'></div>
	<div class='nama1'>No RM</div>
	<div class='norm'>:<?= $model->norm ?></div>
	<div class='nama1'>Tgl Lahir</div>
	<div class='nama'>:10-11-2020</div>
</div>
<div class='obat' style='text-align:center;'>
	<b><?= $resep->dosis ?></b><br> <?= $resep->takaran ?> Sehari
</div><hr>
<div class='nobat'>
	<div class='nama2'>Nama Obat</div>
	<div class='namaobat'>:<strong><?= $resep->obat->namaobat ?></strong></div>
	<div class='nama2'>Khasiat</div>
	<div class='nama22'>:<?= $resep->khasiat ?></div>
	<div class='nama2'>Jumlah</div>
	<div class='nama22'>:<?= $resep->jumlah ?></div>
</div>
<?php endforeach; ?> 