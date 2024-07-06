<?php
use Picqer\Barcode\BarcodeGeneratorHTML;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();

if($model->stpasien == "Baru"){
?>

<div class='nama cntr'><b><?= $model->sbb?>. <?= $model->nama_pasien?> (<?= $model->jenis_kelamin?>)</b></div>
<div class='judul' style='text-align:center;'><?= $model->alamat ?><br></div>
<div class='rmt'><b><?= $model->no_rekmed?></b></div>

<div class='barcdc'><div class='judul'>RSAU LANUD SULAIMAN</div><?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($model->no_rekmed, $generator::TYPE_CODE_128)) . '">'; ?></div>
<div class='nama cntr'><b><?= $model->sbb?>. <?= $model->nama_pasien?> (<?= $model->jenis_kelamin?>)</b></div>

<div class='rmt'><b><?= $model->no_rekmed?></b></div>

<div class='barcdc'><div class='judul'>RSAU LANUD SULAIMAN</div><?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($model->no_rekmed, $generator::TYPE_CODE_128)) . '">'; ?></div>
<div style='margin-bottom:20px;'>
<?php }else{echo"";}?>
<?php if($rawatjalan->idjenisrawat == 1){?>
<div class='nama'><b><?= $model->sbb?>. <?= $model->nama_pasien?> (<?= $model->jenis_kelamin?>)  </div>

<div class='rawatlb'>
<b><?= $model->no_rekmed?></b> || <b>  <?= date('d F Y',strtotime($model->tanggal_lahir)) ?> ( <?= $model->usia?> Th ) </b>
</div>
<?php if($rawatjalan->idjenisrawat == 1){?>
 <?= $rawatjalan->jerawat->jenisrawat?> | <?= $rawatjalan->polii->namapoli?> <?= $rawatjalan->carabayar->jenisbayar ?>
<div class='dokter'><b><?= $rawatjalan->dokter->namadokter?><b></div><?php }else if($rawatjalan->idjenisrawat == 2){?><?= $rawatjalan->jerawat->jenisrawat ?>|
Ruangan : <?= $rawatjalan->kamar->namaruangan?>, <?= $rawatjalan->kelas->namakelas?> | <?= $rawatjalan->carabayar->jenisbayar ?> |
<div class='dokter'><b><?= $rawatjalan->dokter->namadokter?><b></div>
<?php }else {echo $rawatjalan->jerawat->jenisrawat." | ".$rawatjalan->carabayar->jenisbayar ;}?> 




<div class='tgldaf'>
<?= $rawatjalan->tgldaftar ?> 
</div>
<div class='barcd'>
<?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($model->no_rekmed, $generator::TYPE_CODE_128)) . '">'; ?></div>

<div class='nama'><b><?= $model->sbb?>. <?= $model->nama_pasien?> (<?= $model->jenis_kelamin?>)  </div>

<div class='rawatlb'>
<b><?= $model->no_rekmed?></b> || <b>  <?= date('d F Y',strtotime($model->tanggal_lahir)) ?> ( <?= $model->usia?> Th ) </b>
</div>
<?php if($rawatjalan->idjenisrawat == 1){?>
 <?= $rawatjalan->jerawat->jenisrawat?> | <?= $rawatjalan->polii->namapoli?> <?= $rawatjalan->carabayar->jenisbayar ?>
<div class='dokter'><b><?= $rawatjalan->dokter->namadokter?><b></div><?php }else if($rawatjalan->idjenisrawat == 2){?><?= $rawatjalan->jerawat->jenisrawat ?>|
Ruangan : <?= $rawatjalan->kamar->namaruangan?>, <?= $rawatjalan->kelas->namakelas?> | <?= $rawatjalan->carabayar->jenisbayar ?> |
<div class='dokter'><b><?= $rawatjalan->dokter->namadokter?><b></div>
<?php }else {echo $rawatjalan->jerawat->jenisrawat." | ".$rawatjalan->carabayar->jenisbayar ;}?> 




<div class='tgldaf'>
<?= $rawatjalan->tgldaftar ?> 
</div>
<div class='barcd'>
<?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($model->no_rekmed, $generator::TYPE_CODE_128)) . '">'; ?></div>
<div class='nama'><b><?= $model->sbb?>. <?= $model->nama_pasien?> (<?= $model->jenis_kelamin?>) </div>

<div class='rawatlb'>
<b><?= $model->no_rekmed?></b> || <b>  <?= date('d F Y',strtotime($model->tanggal_lahir)) ?> ( <?= $model->usia?> Th ) </b>
</div>
<?php if($rawatjalan->idjenisrawat == 1){?>
 <?= $rawatjalan->jerawat->jenisrawat?> | <?= $rawatjalan->polii->namapoli?> <?= $rawatjalan->carabayar->jenisbayar ?>
<div class='dokter'><b><?= $rawatjalan->dokter->namadokter?><b></div><?php }else if($rawatjalan->idjenisrawat == 2){?><?= $rawatjalan->jerawat->jenisrawat ?>|
Ruangan : <?= $rawatjalan->kamar->namaruangan?>, <?= $rawatjalan->kelas->namakelas?> | <?= $rawatjalan->carabayar->jenisbayar ?> |
<div class='dokter'><b><?= $rawatjalan->dokter->namadokter?><b></div>
<?php }else {echo $rawatjalan->jerawat->jenisrawat." | ".$rawatjalan->carabayar->jenisbayar ;}?> 




<div class='tgldaf'>
<?= $rawatjalan->tgldaftar ?> 
</div>
<div class='barcd'>
<?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($model->no_rekmed, $generator::TYPE_CODE_128)) . '">'; ?></div>

<?php }else{?>
<div class='nama'><b><?= $model->sbb?>. <?= $model->nama_pasien?> (<?= $model->jenis_kelamin?>)  </div>

<div class='rawatlb'>
<b><?= $model->no_rekmed?></b> || <b>  <?= date('d F Y',strtotime($model->tanggal_lahir)) ?> ( <?= $model->usia?> Th ) </b>
</div>
<?php if($rawatjalan->idjenisrawat == 1){?>
 <?= $rawatjalan->jerawat->jenisrawat?> | <?= $rawatjalan->polii->namapoli?> <?= $rawatjalan->carabayar->jenisbayar ?>
<div class='dokter'><b><?= $rawatjalan->dokter->namadokter?><b></div><?php }else if($rawatjalan->idjenisrawat == 2){?><?= $rawatjalan->jerawat->jenisrawat ?>|
Ruangan : <?= $rawatjalan->kamar->namaruangan?>, <?= $rawatjalan->kelas->namakelas?> | <?= $rawatjalan->carabayar->jenisbayar ?> |
<div class='dokter'><b><?= $rawatjalan->dokter->namadokter?><b></div>
<?php }else {echo $rawatjalan->jerawat->jenisrawat." | ".$rawatjalan->carabayar->jenisbayar ;}?> 




<div class='tgldaf'>
<?= $rawatjalan->tgldaftar ?> 
</div>
<div class='barcd'>
<?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($model->no_rekmed, $generator::TYPE_CODE_128)) . '">'; ?></div>

<div class='nama'><b><?= $model->sbb?>. <?= $model->nama_pasien?> (<?= $model->jenis_kelamin?>)  </div>

<div class='rawatlb'>
<b><?= $model->no_rekmed?></b> || <b>  <?= date('d F Y',strtotime($model->tanggal_lahir)) ?> ( <?= $model->usia?> Th ) </b>
</div>
<?php if($rawatjalan->idjenisrawat == 1){?>
 <?= $rawatjalan->jerawat->jenisrawat?> | <?= $rawatjalan->polii->namapoli?> <?= $rawatjalan->carabayar->jenisbayar ?>
<div class='dokter'><b><?= $rawatjalan->dokter->namadokter?><b></div><?php }else if($rawatjalan->idjenisrawat == 2){?><?= $rawatjalan->jerawat->jenisrawat ?>|
Ruangan : <?= $rawatjalan->kamar->namaruangan?>, <?= $rawatjalan->kelas->namakelas?> | <?= $rawatjalan->carabayar->jenisbayar ?> |
<div class='dokter'><b><?= $rawatjalan->dokter->namadokter?><b></div>
<?php }else {echo $rawatjalan->jerawat->jenisrawat." | ".$rawatjalan->carabayar->jenisbayar ;}?> 




<div class='tgldaf'>
<?= $rawatjalan->tgldaftar ?> 
</div>
<div class='barcd'>
<?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($model->no_rekmed, $generator::TYPE_CODE_128)) . '">'; ?></div>

<div class='nama'><b><?= $model->sbb?>. <?= $model->nama_pasien?> (<?= $model->jenis_kelamin?>) </div>

<div class='rawatlb'>
<b><?= $model->no_rekmed?></b> || <b>  <?= date('d F Y',strtotime($model->tanggal_lahir)) ?> ( <?= $model->usia?> Th ) </b>
</div>
<?php if($rawatjalan->idjenisrawat == 1){?>
 <?= $rawatjalan->jerawat->jenisrawat?> | <?= $rawatjalan->polii->namapoli?> <?= $rawatjalan->carabayar->jenisbayar ?>
<div class='dokter'><b><?= $rawatjalan->dokter->namadokter?><b></div><?php }else if($rawatjalan->idjenisrawat == 2){?><?= $rawatjalan->jerawat->jenisrawat ?>|
Ruangan : <?= $rawatjalan->kamar->namaruangan?>, <?= $rawatjalan->kelas->namakelas?> | <?= $rawatjalan->carabayar->jenisbayar ?> |
<div class='dokter'><b><?= $rawatjalan->dokter->namadokter?><b></div>
<?php }else {echo $rawatjalan->jerawat->jenisrawat." | ".$rawatjalan->carabayar->jenisbayar ;}?> 




<div class='tgldaf'>
<?= $rawatjalan->tgldaftar ?> 
</div>
<div class='barcd'>
<?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($model->no_rekmed, $generator::TYPE_CODE_128)) . '">'; ?></div>

<div class='nama'><b><?= $model->sbb?>. <?= $model->nama_pasien?> (<?= $model->jenis_kelamin?>)  </div>

<div class='rawatlb'>
<b><?= $model->no_rekmed?></b> || <b>  <?= date('d F Y',strtotime($model->tanggal_lahir)) ?> ( <?= $model->usia?> Th ) </b>
</div>
<?php if($rawatjalan->idjenisrawat == 1){?>
 <?= $rawatjalan->jerawat->jenisrawat?> | <?= $rawatjalan->polii->namapoli?> <?= $rawatjalan->carabayar->jenisbayar ?>
<div class='dokter'><b><?= $rawatjalan->dokter->namadokter?><b></div><?php }else if($rawatjalan->idjenisrawat == 2){?><?= $rawatjalan->jerawat->jenisrawat ?>|
Ruangan : <?= $rawatjalan->kamar->namaruangan?>, <?= $rawatjalan->kelas->namakelas?> | <?= $rawatjalan->carabayar->jenisbayar ?> |
<div class='dokter'><b><?= $rawatjalan->dokter->namadokter?><b></div>
<?php }else {echo $rawatjalan->jerawat->jenisrawat." | ".$rawatjalan->carabayar->jenisbayar ;}?> 




<div class='tgldaf'>
<?= $rawatjalan->tgldaftar ?> 
</div>
<div class='barcd'>
<?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($model->no_rekmed, $generator::TYPE_CODE_128)) . '">'; ?></div>

<div class='nama'><b><?= $model->sbb?>. <?= $model->nama_pasien?> (<?= $model->jenis_kelamin?>) | </div>

<div class='rawatlb'>
<b><?= $model->no_rekmed?></b> || <b>  <?= date('d F Y',strtotime($model->tanggal_lahir)) ?> ( <?= $model->usia?> Th ) </b>
</div>
<?php if($rawatjalan->idjenisrawat == 1){?>
 <?= $rawatjalan->jerawat->jenisrawat?> | <?= $rawatjalan->polii->namapoli?> <?= $rawatjalan->carabayar->jenisbayar ?>
<div class='dokter'><b><?= $rawatjalan->dokter->namadokter?><b></div><?php }else if($rawatjalan->idjenisrawat == 2){?><?= $rawatjalan->jerawat->jenisrawat ?>|
Ruangan : <?= $rawatjalan->kamar->namaruangan?>, <?= $rawatjalan->kelas->namakelas?> | <?= $rawatjalan->carabayar->jenisbayar ?> |
<div class='dokter'><b><?= $rawatjalan->dokter->namadokter?><b></div>
<?php }else {echo $rawatjalan->jerawat->jenisrawat." | ".$rawatjalan->carabayar->jenisbayar ;}?> 




<div class='tgldaf'>
<?= $rawatjalan->tgldaftar ?> 
</div>
<div class='barcd'>
<?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($model->no_rekmed, $generator::TYPE_CODE_128)) . '">'; ?></div>

<?php } ?>