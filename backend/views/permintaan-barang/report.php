<?php
	use common\models\PermintaanBarangDetail;
	$detail = PermintaanBarangDetail::find()->where(['idpermintaan'=>$model->idpermintaan])->andwhere(['>','qty',0])->all();
?>

<div style='width:100%; text-align:center; '>
	<div style='width:100%;'>
		<div style='width:30%; border-bottom:1px solid; padding-bottom:5px;'>
		KODIKLATAU <BR>PANGKALAN TNI AU SULAIMAN
		</div>
		
	</div>

</div>
<div class='judul-kunjungan'>
	<b>Usul Pesanan <br><?= date('F Y',strtotime($model->tanggal))?></span> </b>
</div>
<div class='pengunjungg'> 
	<table class='table table-bordered'>
		<tr>
			<th>No</th>
			<th>Nama Obat</th>
			<th>Jumlah</th>
			<th>Satuan</th>
			<th>Harga Satuan</th>
			<th>Total</th>
		</tr>
		<?php $no=1; foreach($detail as $d): ?>
		<tr>
			<td><?=  $no++ ?></td>
			<td><?=  $d->namaobat ?></td>
			<td><?=  $d->qty ?></td>
			<td><?=  $d->satuan->satuan ?></td>
			<td>Rp. <?=  Yii::$app->algo->IndoCurr($d->harga) ?></td>
			<td>Rp. <?=  Yii::$app->algo->IndoCurr($d->total) ?></td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td align='right' colspan='5'><b>Sub Total<b></td>
			<td><b>Rp. <?=  Yii::$app->algo->IndoCurr($model->total) ?></b></td>
		</tr>

		
	</table>
</div>