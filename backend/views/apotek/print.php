<?php
	$no=1;
?>
<div class='judul-kunjungan'>
	<b>Data Obat Apotek</b>
	</div>
<div class="trx" style="font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
	<table>
		<tr>
			<th>No</th>
			<th>Nama Obat</th>
			<th>ED</th>
			<th>Stok</th>
			<th>Satuan</th>
		</tr>
		<?php foreach($obat as $o): ?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $o->namaobat ?></td>
			<td><?= $o->kadaluarsa ?></td>
			<td><?= $o->stok ?></td>
			<td><?= $o->satuan->satuan ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>