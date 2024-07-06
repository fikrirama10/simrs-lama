<?php
$hitung = count($json);
$hitung2 = count($json2);
use yii\helpers\Url;
?>
<h4>Transaksi </h4>
<table class='table table-sm table-hover table-bordered'>
	<thead>
		<tr>
			<th>No Rekmed</th>
			<th>No Rawat</th>
			<th>Nama Pasien</th>
			<th>Tanggal Daftar</th>
			<th>Jenis Rawat</th>
			<th>Jenis Bayar</th>
			<th>Poliklinik</th>
		</tr>
	</thead>
	<tbody>		
		<?php $no=1; for($a=0; $a < count($json); $a++){ ?>		
		<tr>
			<td><?= $json[$a]['NoRm'] ?></td>
			<td><a href='<?= Url::to(['resep/'.$json[$a]['Id']]) ?>'><?= $json[$a]['IdRawat'] ?></a></td>
			<td><?= $json[$a]['Nama'] ?></td>
			<td><?= $json[$a]['TglDaftar'] ?></td>
			<td><?= $json[$a]['JenisRawat'] ?></td>
			<td><?= $json[$a]['JenisBayar'] ?></td>
			<td><?= $json[$a]['Poliklinik'] ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<hr>
<h4>List Resep</h4>
<table class='table table-sm table-hover table-bordered'>
	<thead>
		<tr>
			<th>No Rekmed</th>
			<th>No Resep</th>
			<th>Nama Pasien</th>
			<th>Tanggal Resep</th>
			<th>Jenis Rawat</th>
			<th>Jenis Bayar</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>		
		<?php $no=1; for($a=0; $a < count($json2); $a++){ ?>		
		<tr>
			<td><?= $json2[$a]['NoRm'] ?></td>
			<td><a href='<?= Url::to(['resep/'.$json2[$a]['IdRajal']]) ?>'target='_blank'><?= $json2[$a]['IdResep'] ?></a></td>
			<td><?= $json2[$a]['Nama'] ?></td>
			<td><?= $json2[$a]['TglDaftar'] ?></td>
			<td><?= $json2[$a]['JenisRawat'] ?></td>
			<td><?= $json2[$a]['JenisBayar'] ?></td>
			<td><?= $json2[$a]['Total'] ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>