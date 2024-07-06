<?php
use common\models\Apotekmutasi;
$mutasi = Apotekmutasi::find()->where(['idobat'=>$model->id])->andwhere(['ke'=>'Farmasi'])->all();
$jumlah = $model->stok + $model->stokgudang;
$no = 1;
?>
<div class='box box-body'>
<a>Nama Barang</a>
<h4><?= $model->namaobat?> (<?= $model->stok ?> <?= $model->satuan->satuan?>)</h4>
<p> Stok di Apotek : <?= $model->stok?></p>
<hr>
<p>Mutasi Stok</p>
	<table class='table table-bordered'>
		<tr>
			<th>No</th>
			<th>Ket</th>
			<th>Dari</th>
			<th>Status</th>
			<th>Tanggal</th>
			<th>Jumlah</th>
			<th>Ke</th>
		</tr>
		<?php foreach($mutasi as $mut): ?>
		<?php if($mut->ke == 'Perawatan'){echo"<tr style='color:#fff;' bgcolor='red'>";}else if($mut->ke == null){echo"<tr style='color:#fff;' bgcolor='green'>";} else{echo"<tr>";} ?>
		
			<td><?= $no++ ?></td>
			<td><?= $mut->ket?></td>
			<td><?= $mut->dari?></td>
			<td><?= $mut->status ?></td>
			<td><?= date('d/m/Y',strtotime($mut->tanggal)) ?></td>
			<td><?= $mut->jumlah ?> <?= $mut->satu->satuan?></td>
			<td><?= $mut->ke ?></td>
			
		</tr>
		<?php endforeach; ?>
	</table>
</div>