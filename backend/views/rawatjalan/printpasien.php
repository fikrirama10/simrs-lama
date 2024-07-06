<?php
use Picqer\Barcode\BarcodeGeneratorHTML;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
?>
<?php if($rawatjalan->idjenisrawat == 1){?>
<div style='font-size:50px; text-align:center;line-height:60px; background:#fff;color:#000;'>
<?php if($rawatjalan->anggota == 1){?>
<?= $rawatjalan->polii->icon.'-'.substr($rawatjalan->antrian,12)?><br>
<?php }else{ ?>
<?= $rawatjalan->polii->icon.'-'.substr($rawatjalan->antrian+5,11)?><br>
<?php } ?>
</div>

<div style='font-size:10px; text-align:center; background:#fff;color:#000;'><b><?= date('Y/m/d',strtotime($rawatjalan->tgldaftar))?></b></div><br>
<?php } ?>
<?php if($rawatjalan->idkb != 2){ ?>
<div class='nama cntr'><b><?= $model->sbb?>. <?= $model->nama_pasien?> (<?= $model->jenis_kelamin?>)</b></div>
<div class='judul' style='text-align:center;'><?= $model->alamat ?><br></div>
<div class='rmt'><b><?= $model->no_rekmed?></b></div>

<div class='barcdc'><div class='judul'>RSAU LANUD SULAIMAN</div><?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($model->no_rekmed, $generator::TYPE_CODE_128)) . '">'; ?></div>
<div class='nama cntr'><b><?= $model->sbb?>. <?= $model->nama_pasien?> (<?= $model->jenis_kelamin?>)</b></div>

<div class='rmt'><b><?= $model->no_rekmed?></b></div>

<div class='barcdc'><div class='judul'>RSAU LANUD SULAIMAN</div><?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($model->no_rekmed, $generator::TYPE_CODE_128)) . '">'; ?></div>
<div style='margin-bottom:20px;'></div>
<div class='rawatlb' style='text-align:left;'>
	<?php if($rawatjalan->idjenisrawat == 3){ ?>
		<?php for($i = 0; $i < 8; $i++){ ?>
		<div class='nama'><b><?= $model->sbb?>. <?= $model->nama_pasien?> (<?= $model->jenis_kelamin?>)</b></div>
		<div class='judul' style='text-align:left;'><?= date('d F Y',strtotime($model->tanggal_lahir)) ?> ( <?= $model->usia?> th )<br></div>
		
		<div class='rmedis'><b><?= $model->no_rekmed?></b><br></div>
				

	
		<?php } ?>

	<?php }else if($rawatjalan->idjenisrawat == 1 ){ ?>
		<?php for($i = 0; $i < 6; $i++){ ?>
		<div class='nama'><b><?= $model->sbb?>. <?= $model->nama_pasien?> (<?= $model->jenis_kelamin?>)</b></div>
<div class='judul' ><?= date('d F Y',strtotime($model->tanggal_lahir)) ?> ( <?= $model->usia?> th )<br></div>

<div class='rmedis'><b><?= $model->no_rekmed?></b><br></div>

		<?php } ?>
	<?php }else{ ?>
		<?php for($i = 0; $i < 20; $i++){ ?>
		<div class='nama'><b><?= $model->sbb?>. <?= $model->nama_pasien?> (<?= $model->jenis_kelamin?>)</b></div>
<div class='judul' style='text-align:left;'><?= date('d F Y',strtotime($model->tanggal_lahir)) ?> ( <?= $model->usia?> th )<br></div>

<div class='rmedis'><b><?= $model->no_rekmed?></b><br></div>

		<?php } ?>
	<?php }?>

<?php }else{ ?>
			<?php if($rawatjalan->idjenisrawat == 3){ ?>
		<?php for($i = 0; $i < 4; $i++){ ?>
		<div class='nama'><b><?= $model->sbb?>. <?= $model->nama_pasien?> (<?= $model->jenis_kelamin?>)</b></div>
<div class='judul' style='text-align:left;'><?= date('d F Y',strtotime($model->tanggal_lahir)) ?> ( <?= $model->usia?> th )<br></div>

<div class='rmedis'><b><?= $model->no_rekmed?></b><br></div>

		<?php } ?>

	<?php }else if($rawatjalan->idjenisrawat == 1 ){ ?>
		
		<?php for($i = 0; $i < $rawatjalan->polii->poll ; $i++){ ?>
		<div class='nama'><b><?= $model->sbb?>. <?= $model->nama_pasien?> (<?= $model->jenis_kelamin?>)</b></div>
<div class='judul' style='text-align:left;'><?= date('d F Y',strtotime($model->tanggal_lahir)) ?> ( <?= $model->usia?> th )<br></div>

<div class='rmedis'><b><?= $model->no_rekmed?></b><br></div>

		<?php } ?>
	<?php }else{ ?>
		<?php for($i = 0; $i < 20; $i++){ ?>
	<div class='nama'><b><?= $model->sbb?>. <?= $model->nama_pasien?> (<?= $model->jenis_kelamin?>)</b></div>
<div class='judul' style='text-align:left;'><?= date('d F Y',strtotime($model->tanggal_lahir)) ?> ( <?= $model->usia?> th )<br></div>

<div class='rmedis'><b><?= $model->no_rekmed?></b><br></div>

		<?php } ?>
	<?php }?>

<?php }?>
<div class='nama'><b><?= $model->sbb?>. <?= $model->nama_pasien?> (<?= $model->jenis_kelamin?>)</div>
<div class='judul'><b><?= $model->no_rekmed?> | <?= $rawatjalan->jerawat->jenisrawat?> | <?= $rawatjalan->idrawat?> | <?= date('d F Y',strtotime($model->tanggal_lahir)) ?></div>
<div class='rmedis'><b><?= date('H:i A',strtotime($rawatjalan->tgldaftar)) ?></b></div>

