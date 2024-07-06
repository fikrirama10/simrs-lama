<?php 
use yii\helpers\Html;
?>
<a>Obat </a>
<table class='table table-bordered'>
	<tr>
		<td>No</td>
		<td>IdObat</td>
		<td>Nama Obat</td>
		<td>Stok Awal</td>		
		<td>Stok Masuk</td>
		<td>Stok Keluar</td>
		<td>Stok / Sisa</td>
		<td>#</td>
	</tr>
	<?php $no=1; foreach($stokyanmas as $sy): ?>
	<tr>
		<td><?=  $no++ ?> </td>
		<td><?=  $sy->idobat ?> </td>
		<td><?=  $sy->obat->namaobat ?> (<?= $sy->obat->jenis->jenisbayar ?>) </td>
		<td><?=  $sy->stokawal ?> </td>
		<td><?=  $sy->stokmasuk ?> </td>
		<td><?=  $sy->stokkeluar ?> </td>
		<td><?=  $sy->stokakhir ?> </td>
		<td><a href='<?= Yii::$app->params['baseUrl'].'/dashboard/apotek/detail-laporan-obat/?id='.$sy->id?>'  class='btn btn-success btn-xs'>Lihat</a></td>
	</tr>
	<?php endforeach; ?>
</table>