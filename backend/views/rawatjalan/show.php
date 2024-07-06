<table class='table table-hovered'>
	<tr>
		<th>Tgl</th>
		<th>Poli</th>
		<th>Dokter</th>
		<th>Kuota</th>
		<th>Sisa</th>
	</tr>
	<?php foreach($jadwal as $j){?>
	<tr>
		<td><?= $j->tgl ?></td>
		<td><?= $j->poli->namapoli ?></td>
		<td><?= $j->dokter->namadokter ?></td>
		<td><?= $j->kuota ?></td>
		<td><?= $j->sisa ?>
	<?php }?>
</table>

<hr>
<h3>Pasien Anggota</h3><hr>
<table class='table table-bordered'>
	<tr>
		<th>No RM</th>
		<th>Nama</th>
		<th>Poli</th>
		<th>Dokter</th>
		<th>No antrian</th>
	</tr>
	<?php foreach($model as $m):?>
	<tr>
		<th><?= $m->no_rekmed ?></th>
		<th><?= $m->pasien->nama_pasien ?></th>
		<th><?= $m->polii->namapoli ?></th>
		<th><?= $m->dokter->namadokter ?></th>
		<td><h3><span class='label label-primary'><?= $m->polii->icon.'-'.substr($m->antrian,12)?></span></h3></td>
	</tr>
	<?php endforeach; ?>
</table>
<h3>Pasien Umum</h3><hr>
<table class='table table-bordered'>
	<tr>
		<th>No RM</th>
		<th>Nama</th>
		<th>Bayar</th>
		<th>Dokter</th>
		<th>No antrian</th>
	</tr>
	<?php foreach($umum as $m):?>
	<tr>
		<td><?= $m->no_rekmed ?></td>
		<td><?= $m->pasien->nama_pasien ?></td>
		<td><?= $m->carabayar->jenisbayar ?></td>
		<td><?= $m->dokter->namadokter ?></td>
		<td><h3><span class='label label-primary'><?= $m->polii->icon.'-'.substr($m->antrian+5,11)?></span></h3></td>
	</tr>
	<?php endforeach; ?>
</table>

