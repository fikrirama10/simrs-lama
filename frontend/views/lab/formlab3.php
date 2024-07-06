<?php 
use yii\helpers\Html;
use Picqer\Barcode\BarcodeGeneratorHTML;
use common\models\Pemriklab;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
$plab = Pemriklab::find()->where(['idlab'=> $pemriklab->id])->all();
$no=1;
?>
<div class='header-lab'>
	<div class='header-lab-judul'>
		<div class="header-lab-judul-au">
		<h5>PANGKALAN TNI AU SULAIMAN RUMAH SAKIT</h5>
		</div>
		<div class="header-lab-judul-pasien">
			

		</div>
		
	</div>
	<div class='header-lab-logo'>
		<?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($pemriklab->idrawat, $generator::TYPE_CODE_128)) . '">'; ?>
		<div style='font-size:11px; letter-spacing: 6px;'>
			<?= $pemriklab->idrawat ?> 
			</div>
	</div>

	

</div>
<div class='body-lab'>
			<table>
				<tr>
					<td class='nolborder' width=100>Nama</td>
					<td class='nolborder' >:</td>
					<td class='nolborder'  width=200><?= $pemriklab->pasien->sbb ?>. <?= $pemriklab->pasien->nama_pasien?></td>
					<td class='nolborder'  width=120>RM</td>
					<td class='nolborder' >:</td>
					<td class='nolborder'  width=200><?= $pemriklab->no_rekmed ?></td>
				</tr>
				<tr>
					<td class='nolborder'  width=100>Umur</td>
					<td class='nolborder' >:</td>
					<td class='nolborder'  width=200><?= $pemriklab->pasien->usia?> th</td>
					<td class='nolborder'  width=120>Tanggal</td>
					<td class='nolborder' >:</td>
					<td class='nolborder'  width=200><?= date('d F Y',strtotime($pemriklab->tanggal_req )) ?></td>
				</tr>
				<tr>
					<td class='nolborder'  width=120>Dokter Pengirim</td>
					<td class='nolborder' >:</td>
					<td class='nolborder'  width=200><?= $pemriklab->dokter->namadokter?></td>
				</tr>
			
					
			</table>
</div><hr>
<div class='lab-body-hasil'>
<h4><?= $pemriklab->katlab->nama ?></h4>
<table>
	<tr>
		<td><b>No</b></td>
		<td><b>Pemeriksaan</b></td>
		<td><b>Hasil</b></td>
		
	</tr>
	<?php foreach($plab as $lab): ?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $lab->kat->nama ?></td>
			<td><?= $lab->hasil ?> </td>
			
		</tr>
	<?php endforeach; ?>
	
</table>
</div>
