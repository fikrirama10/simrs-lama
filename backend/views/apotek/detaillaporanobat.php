<?php

use common\models\Kartustok;	
$karstok = Kartustok::find()->where(['idobat'=>$stokopname->idobat])->andwhere(['DATE_FORMAT(tgl,"%Y-%m-%d")'=>$stokopname->tanggal])->all();
$no=1;
?>
<div class='box box-body'>
<h4><?= $stokopname->obat->namaobat ?></h4><hr>
<table class='table table-bordered'>
	<tr>
		<th>No</th>
		<th>Tanggal</th>
		<th>Jenis Mutasi</th>
		<th>Qty</th>
		<th>Masuk</th>
		<th>Keluar</th>
	</tr>
	<?php foreach($karstok as $kr): ?>
	<tr>
		<td><?= $no++ ?></td>
		<td><?= $kr->tgl ?></td>
		<td><?= $kr->mutasi->jenismutasi ?></td>
		<td><?= $kr->qty ?></td>
		<td><?= $kr->stokmasuk ?></td>
		<td><?= $kr->stokkeluar ?></td>
	</tr>
	<?php endforeach; ?>
	
</table>
</div>