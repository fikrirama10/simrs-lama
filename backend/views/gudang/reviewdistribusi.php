<?php
use common\models\Itemdistri;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;
use yii\helpers\Url;
$no=1;
$dafbeli = Itemdistri::find()->where(['nodistri'=>$model->nodistri])->all(); 
?>
<div class='box box-body'>

			<hr>
			<h4>No Distribusi : <?= $model->nodistri ?></h4>
		
			<a style='color:grey;'>Distribusi dari: Gudang ke <?= $model->tempat ?></a>
			<h6>tanggal distribusi barang <?= date('d F Y',strtotime($model->tanggal)) ?></h6>
			<hr>

<table class='table table-bordered'>
	<tr>
		<th>No</th>
		<th>Nama Barang</th>
		<th>Jumlah</th>
		<th>Satuan</th>
		<th>#</th>
	</tr>
	<?php foreach($dafbeli as $df):?>
	<tr>
		<td><?= $no++ ?></td>
		<td><?= $df->idobat ?></td>
		<td><?= $df->jumlah ?></td>
		<td><?= $df->satu->satuan?></td>
		<?php if($df->status == null){echo'<td><span class="label label-danger">Belum Masuk Stok</span></td>';}else{echo'<td><span class="label label-primary">Telah Masuk Stok</span></td>';} ?>
		<td>
		<?php if($df->status != null){echo'';}else{ ?>
		<a class='btn btn-warning btn-xs' href='<?= Url::to(['gudang/tambahdistri/'.$df->id])?>' >Tambah ke Stok</a> <a class='btn btn-danger btn-xs' >Koreksi</a><?php } ?>  </td>
	</tr>
	<?php endforeach; ?>
</table>
<hr>
<a class='btn btn-success'>Selesai</a>
</div>
