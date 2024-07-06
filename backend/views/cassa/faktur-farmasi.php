<?php 
use yii\helpers\Html;
use Picqer\Barcode\BarcodeGeneratorHTML;
use common\models\Trxapotek;
use common\models\Trxresep;
$apotek = Trxapotek::find()->where(['idrawat'=>$model->idrawat])->all();
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
$harga_total = 0;
$hargatotal = 0;
$no = 1;
?>
<div class='header1'>
	<div class='logo'>
	<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/hitput.png',['class' => 'img img-responsive']);?>
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
	<div class='body-far2'>
	<table>
		<?php foreach($apotek as $ap): ?>
		<tr>
			<td colspan='4'><?= $ap->idtrx ?></td>
			<td><?= date('Y/m/d',strtotime($ap->tglresep)) ?></td>
		</tr>
		<tr>
			<th>No</th>
			<th width='320' >Nama Obat</th>
			<th width='120'>Jumlah</th>
			<th width='160'>Harga Satuan</th>
			<th width='160'>Total</th>
		</tr>
		<?php $trxapotek = Trxresep::find()->where(['trxid'=>$ap->idtrx])->all(); ?>
			<?php foreach($trxapotek as $tr): ?>
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
				<td align=right colspan="4"><a>Total</a></td>
				<td><a>Rp. <?= Yii::$app->algo->IndoCurr($harga_total)?><a></td>
				
			</tr>
			<?php 
			 $hargatotal += $harga_total;
			?>
	
		<?php endforeach; ?>
			<tr>
			<td colspan='4' align=right></td>
			<td  align=left></td>
		</tr>
		<tr>
			<td colspan='4' align=right><h4>Sub Total</h4></td>
			<td  align=left><h4>Rp. <?= Yii::$app->algo->IndoCurr($hargatotal)?></h4></td>
		</tr>
	</table>
	</div>
	</div>