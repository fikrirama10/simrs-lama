<?php

use yii\helpers\Html;
use common\models\Mcutni;
use Picqer\Barcode\BarcodeGeneratorHTML;

$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
?>
<?php foreach ($rikes as $t) : ?>
	<div class='hea0'>
		<div class='hea1'>
			<u>PANITIA RIK/UJI KESEHATAN</U>
		</div>
		<div class='hea1r' style='text-align:right;'><br><u>RAHASIA KEDOKTERAN</u></div>
	</div>
	<div class='hea0'>
		<div class='hea01'><br>
			LEMBAR EVALUASI KESEHATAN<br><u><?= $model->namakegiatan ?></u><br>
		</div>
	</div>
	<div class='hea0'>
		<div class='hea11'>
			<table>
				<tr>
					<td width=80>Nomer Tes</td>
					<td>:</td>
					<td width=150><?= $t->nomer_tes ?></td>
				</tr>
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td style=' text-transform: capitalize;'><?= $t->nama ?></td>
				</tr>
				<tr>
					<td>Tanggal Tes</td>
					<td>:</td>
					<td><?= $model->tanggal ?></td>
				</tr>
			</table>
		</div>
		<div class='hea11'>
			<table>
				<tr>
					<td width=80>Panda</td>
					<td>:</td>
					<td>Lanud Sulaiman</td>
				</tr>
				<tr>
					<td>Umur</td>
					<td>:</td>
					<td><?= $t->usia ?>th</td>
				</tr>
				<tr>
					<td>No Foto</td>
					<td>:</td>
					<td><?= $t->nofoto ?></td>
				</tr>
			</table>
		</div>
	</div>
	<div class='perik'>
		<div class='hea0'>
			<div class='hea01'>
				<b>PEMERIKSAAN RADIOLOGI</b>
			</div>
		</div>
		Hasil :
		<div class='harad'>
			<p> <?= nl2br(stripslashes($t->pemeriksaan)); ?></p>
		</div><br>
		Kesan :
		<div class='harad'>
			<p> <?= nl2br(stripslashes($t->kesan)); ?></p>
		</div><br>
	</div>
	<div class='hea0' style='margin-top:30px;'>
		<div class='hea1'>
			<div style='width:110px; margin-top:40px; height:20px; border-top:1px solid; border-right:1px solid; text-align:center;  border-left:1px solid;'>
				<u>Kualifikasi</u>
			</div>
			<div style='width:110px; height:20px; border:1px solid;'>
				<?= $t->kualifikasi ?>
			</div>
		</div>
		<div class='hea1' style='text-align:center;'>
			Yang Memeriksa<br>Dokter Unit Radiologi<br><br><br>dr. Deviasari Sp.Rad <br>SIP :445.93/0078.III.2019-DU/DPMPTSP
		</div>
	</div>
	<pagebreak />
<?php endforeach; ?>