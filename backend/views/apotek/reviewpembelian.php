<?php
use common\models\Itembeli;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;
use yii\helpers\Url;
$no=1;
$dafbeli = Itembeli::find()->where(['nofaktur'=>$model->nofaktur])->all(); 
?>
<div class='box box-body'>

			<hr>
			<h4>No Faktur : <?= $model->nofaktur ?></h4>
		
			<a style='color:grey;'>Suplier: <?= $model->idsup ?></a>
			<h6>tanggal masuk barang <?= date('d F Y',strtotime($model->tanggal)) ?></h6>
			<hr>

<table class='table table-bordered'>
	<tr>
		<th>No</th>
		<th>Nama Obat</th>
		<th>Jumlah</th>
		<th>Satuan</th>
		<th>Harga</th>
		<th>Status</th>
		<th>#</th>
	</tr>
	<?php foreach($dafbeli as $df):?>
	<tr>
		<td><?= $no++ ?></td>
		<td><?= $df->nobat->namaobat ?></td>
		<td><?= $df->jumlah ?></td>
		<td><?= $df->satu->satuan?></td>
		<td>Rp <?= $df->harga?></td>
		<?php if($df->status == null){echo'<td><span class="label label-danger">Belum Masuk Stok</span></td>';}else{echo'<td><span class="label label-primary">Telah Masuk Stok</span></td>';} ?>
		<td>
		<?php if($df->status != null){echo'';}else{ ?>
		<a class='btn btn-warning btn-xs' href='<?= Url::to(['apotek/tambah/'.$df->id])?>' >Tambah ke Stok</a> <a class='btn btn-danger btn-xs' >Koreksi</a><?php } ?>  </td>
	</tr>
	<?php endforeach; ?>
</table>
<hr>
<a class='btn btn-success' href='<?= Url::to(['apotek']) ?>'>Selesai</a>
</div>
