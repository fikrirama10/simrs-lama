<?php
use common\models\Itembeli;
$beli = Itembeli::find()->where(['nofaktur'=>$model->nofaktur])->all();
$no=1;
?>
<div class='box box-body'>
<h3>No Faktur : <?= $model->nofaktur?> </h3><hr>
<table class='table table-bordered'>
	<tr>
		<td>No</td>
		<td>Nama Barang</td>
		<td>Kategori</td>
		<td>Jumlah</td>
		<td>Harga</td>
	</tr>
	<?php foreach($beli as $b): ?>
	<tr>
		<td><?= $no++ ?></td>
		<td><?= $b->obat->namaobat ?></td>
		<td><?= $b->obat->katego->kat ?></td>
		<td><?= $b->jumlah ?> <?= $b->obat->satuan->satuan ?></td>
		<td>Rp. <?= $b->jumlah * $b->obat->hargabeli ?> </td>
	</tr>
	<?php endforeach; ?>
</table>
</div>