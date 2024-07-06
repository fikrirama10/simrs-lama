<?php 
use yii\helpers\Html;
use Picqer\Barcode\BarcodeGeneratorHTML;
use common\models\Trandetail;
use common\models\Tarif;
$transd = Trandetail::find()->where(['idtrx'=>$model->idtrx])->andWhere(['idrawat'=>$model->idrawat])->all();

$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
$harga_total = 0;
$no = 1;
?>
<div class='header1'>
	<div class='logo'>
	<?php // Html::img(Yii::$app->params['baseUrl'].'/frontend/images/hitput.png',['class' => 'img img-responsive']);?>
	</div>
	<div class='header2'>
	<h3>RSAU dr.NORMAN T.LUBIS</h3>
	<h5>Jalan Terusan Kopo No 500<br>
	Telp (022) 5409608</h5>
	</div>
	<div class='headerbr'>
		<h3>RINCIAN BIAYA PASIEN</h3>
		<a>INVOICE NO : <?= $model->idtrx?></a>
	</div>
</div>
<div class=''>
	<div class='body-lab'>
			<table>
				<tr>
					<td class='nolborder' width=100>Nama Pasien</td>
					<td class='nolborder' >:</td>
					<td class='nolborder'  width=300><?= $model->pasien->sbb ?>. <?= $model->pasien->nama_pasien ?></td>
					<td class='nolborder'  width=120>NO RM</td>
					<td class='nolborder' >:</td>
					<td class='nolborder'  width=300><?= $model->pasien->no_rekmed ?></td>
				</tr>
				<tr>
					<td class='nolborder'  width=100>Jenis Bayar</td>
					<td class='nolborder' >:</td>
					<td class='nolborder'  width=300><?= $model->bayar->jenisbayar ?></td>
					<td class='nolborder'  width=120>Tanggal</td>
					<td class='nolborder' >:</td>
					<td class='nolborder'  width=300><?= $model->tglbayar ?></td>
				</tr>
				<tr>
					<td class='nolborder'  width=120>Pelayanan</td>
					<td class='nolborder' >:</td>
					<td class='nolborder'  width=300><?= $model->rawat->jerawat->jenisrawat ?></td>
					<td class='nolborder'  width=120>Alamat</td>
					<td class='nolborder' >:</td>
					<td class='nolborder'  width=300><?= $model->pasien->alamat ?></td>
				</tr>
			
					
			</table>
	</div>
	<hr>
	<div class=''>
	<table>
			<tr>
				<th>No</th>
				<th width=340>Tindakan</th>
				<th>Jumlah</th>
				<th width=150>Harga</th>
				<th width=260>Total</th>
			</tr>
			
			<?php foreach($transd as $td): 
			$harga_total +=$td->total;
			?>
			<tr>
				<td><?= $no++?></td>
				<td><?php $tarif= Tarif::findOne($td->idtindakan); if($tarif){echo $tarif->nama;}else{echo'Administrasi pasien';} ?></td>
				<td><?= $td->jumlah ?> Kali</td>
				<td align=right>Rp. <?= Yii::$app->algo->IndoCurr($td->harga)?></td>
				<td align=right>Rp. <?= Yii::$app->algo->IndoCurr($td->total)?></td>
				
				
			</tr>
			<?php endforeach; ?>
			<tr>
				<td align=right colspan="4"><h3>Sub Total</h3></td>
				<td align=right><h3>Rp. <?= Yii::$app->algo->IndoCurr($harga_total)?><h3></td>
				
			</tr>
			
	</table>
	</div>
</div><br><hr>
<div style='width:50%; text-indent:80px; font-size:15px; float:left;'>Kasir / Bendahara</div>