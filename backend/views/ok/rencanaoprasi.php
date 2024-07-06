<?php

use yii\helpers\Url;
/* @var $this yii\web\View */

?>
<div class='box box-body'>
<h4>Waiting List</h4><hr>
<table class='table table-bordered'>
	<tr>
		<th>Nama Pasien</th>
		<th>No RM</th>
		<th>Tanggal Pemeriksaan</th>
		<th>Jadwal Oprasi</th>
		<th>Diagnosa</th>
		<th>Dokter</th>
		<th>Status</th>
		<th>#</th>
	</tr>
	<?php foreach($rencana as $r): ?>
	<tr>
		<td><?= $r->pasien->nama_pasien  ?></td>
		<td><?= $r->no_rekmed  ?></td>
		<td><?=  date('d F Y',strtotime($r->tanggalperiksa  ))  ?></td>
		<td><?= date('d F Y',strtotime($r->jadwaloprasi )) ?></td>
		<td><?= $r->diagnosa  ?></td>
		
		<td><?= $r->dokter->namadokter  ?></td>
		<td><span class="label label-danger"><?= $r->stat->status?></span></span></td>
		<td><a href='<?= Url::to(['rencanaok/'.$r->id])?>' class='btn btn-sm btn-primary'><span class="fa fa-eye"></span></a></td>
	</tr>
	<?php endforeach; ?>
</table>
</div>

