<?php
use yii\helpers\Url;
?>
<h4><?= $title ?> , <?= $tanggal ?></h4>
<table class='table table-bordered'>
	<tr>
		<td>No</td>
		<td>Nama Obat</td>
		<td>Stok Awal</td>		
		<td>Stok Masuk</td>
		<td>Stok Keluar</td>
		<td>Stok / Sisa</td>
		<td>Harga Satuan</td>
		<td>#</td>
	</tr>
	<?php $no1 = 1;  for($a=0; $a < count($json); $a++){ ?>
	<tr>
		<td><?= $no1++ ?></td>
		<td><?=  $json[$a]['namaobat']	?></td>
		<td><?=  $json[$a]['awal']	?></td>
		<td><?=  $json[$a]['masuk']	?></td>
		<td><?=  $json[$a]['keluar']	?></td>
		<td><?=  $json[$a]['akhir']	?></td>
		<td><?=  $json[$a]['harga']	?></td>
		<td><a target='_blank' href='<?= Url::to(['apotek/'.$json[$a]['id']]) ?>'>detail >></a></td>
	</tr>
	<?php } ?>

	</table>