<?php 
use yii\helpers\Html;
use Picqer\Barcode\BarcodeGeneratorHTML;
use common\models\Trxapotek;
use common\models\Trxresep;
$apotek = Trxapotek::find()->where(['idrawat'=>$model->idrawat])->all();
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
$harga_total = 0;
$no = 1;
?>
<div class='header1'>
	<div class='logo'>
	<?php // Html::img(Yii::$app->params['baseUrl'].'/frontend/images/hitput.png',['class' => 'img img-responsive']);?>
	</div>
	<div class='header2'>
	<h3>INSTALASI FARMASI RSAU dr.NORMAN T.LUBIS</h3>
	<h5>Jalan Terusan Kopo No 500<br>
	Telp (022) 5409608</h5>
	</div>
	<div class='headerbr'>
		<br><br>
		<?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($model->idtrx, $generator::TYPE_CODE_128)) . '">'; ?>
		<h4>Rincian Biaya Farmasi</h4>
	</div>
</div>
<div class='detail-pasien'>
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
					<td class='nolborder'  width=300><?= $model->tglresep ?></td>
				</tr>
				<tr>
					<td class='nolborder'  width=120>Pelayanan</td>
					<td class='nolborder' >:</td>
					<td class='nolborder'  width=300><?= $model->jenisrawat->jenisrawat ?></td>
					<td class='nolborder'  width=120>Alamat</td>
					<td class='nolborder' >:</td>
					<td class='nolborder'  width=300><?= $model->pasien->alamat ?></td>
				</tr>
			
					
			</table>
	</div>
	<hr>
	<div class='body-far2'>
	<table>
		
		<tr>
			<th>No</th>
			<th width='320' >Nama Obat</th>
			<th width='120'>Jumlah</th>
			<th width='160'>Harga Satuan</th>
			<th width='160'>Total</th>
		</tr>
		
			<?php foreach($resep as $tr): ?>
			<tr>
				<td><?= $no++ ?></td>
				<td><?= $tr->obat->namaobat ?></td>
				<td><?= $tr->jumlah ?> - <?= $tr->obat->satuan->satuan?></td>
				<td>Rp. <?= Yii::$app->algo->IndoCurr($tr->harga)?></td>
				<td>Rp. <?= Yii::$app->algo->IndoCurr($tr->total)?></td>
			</tr>
				<?php 
			 $harga_total += $tr->total;
			?>
			<?php endforeach; ?>
			<tr>
				<td align=right colspan="4"><h4>Total</h4></td>
				<td><h4>Rp. <?= Yii::$app->algo->IndoCurr($harga_total)?><h4></td>
				
			</tr>
	</table>
	</div>
	</div>
	<br><hr>
<div style='width:50%; text-indent:80px; font-size:15px; float:left;'>Kasir / Bendahara</div>