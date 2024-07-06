<div class='judul'><?= $pemriklab->idrad?>  |  <?= $pemriklab->drad->jenispemeriksaan ?> | No: <?= $pemriklab->nofoto ?></div>
<div class='rmedis2'><b><?= $pemriklab->rad->pasien->no_rekmed?></b><br></div>
<div class='nama2'><b><?= $pemriklab->rad->pasien->sbb?> .<?= substr($pemriklab->rad->pasien->nama_pasien,0,15)?> (<?= $pemriklab->rad->pasien->usia?> th)</b></div>
<div class='judul'><?= $pemriklab->rad->pasien->alamat?> </div>
<div class='judul'><?= $pemriklab->rad->dokter->namadokter?> </div>