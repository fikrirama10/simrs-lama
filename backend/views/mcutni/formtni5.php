<?php 
use yii\helpers\Html;
use common\models\Mcutni;
use Picqer\Barcode\BarcodeGeneratorHTML;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
$tni = Mcutni::find()->where(['between','id',396,528])->all();
?>
<?php foreach($tni as $t): ?>
 <div class = 'hea0'>
	<div class='hea1'>
	PANITIA RIK/UJI KESEHATAN<br><U>PENERIMAAN PRAJURIT TNI AU</U>
	</div>
	<div class='hea1r' style='text-align:right;'><br><u>RAHASIA KEDOKTERAN</u></div>
 </div>
 <div class = 'hea0'>
	<div class ='hea01'><br>
		LEMBAR EVALUASI KESEHATAN<br><u>SELEKSI CALON BINTARA PK TINGKAT DAERAH</u><br>
	</div>
 </div>
 <div class = 'hea0' >
	<div class='hea11'>
	<table>
		<tr>
			<td width=80>Nomer Tes</td>
			<td>:</td>
			<td width=150><?= $t->notes?></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td style=' text-transform: capitalize;'><?= $t->nama?></td>
		</tr>
		<tr>
			<td>Tanggal Tes</td>
			<td>:</td>
			<td>13/12/2019</td>
		</tr>
	</table>
	</div>
	<div class='hea11'>
		<table>
		<tr>
			<td  width=80>Panda</td>
			<td>:</td>
			<td>Lanud Sulaiman</td>
		</tr>
		<tr>
			<td>Umur</td>
			<td>:</td>
			<td><?= $t->usia?>th</td>
		</tr>
		<tr>
			<td>No Foto</td>
			<td>:</td>
			<td><?= $t->nofoto?></td>
		</tr>
	</table>
	</div>
 </div>
 <div class='perik'>
  <div class = 'hea0'>
	<div class ='hea01'>
		<b>PEMERIKSAAN RADIOLOGI</b>
	</div>
  </div>
    <div class = 'hea0'>
		<div class='perik1'><br><b>PEMERIKSAAN :</b></div>
		<div class='perik2'><br><b>Cor sinuses dan diafragma normal<br>Pulmo : Hilli normal<br>Corakan bronkhovaskuler normal.<br>Tidak tampak infiltrat</b></div>
	</div>
	 <div class = 'hea0'>
		<div class='perik11'><br><b>KESAN :</b></div>
		<div class='perik3'><br><b>
		<?php if($t->id == 11){?>
		Suspek bifid rib os costa 3 kanan
		<?php }else if($t->id == 40){ ?>
		Skoliosis minimal vebrata torakalis DD/Popipi
		<?php }else if($t->id == 468){?>
		Bifid rib os costa 4 kanan
		
		<?php }else if($t->id == 511 || $t->id == 425 ){?>
		Microcardia (CTR 32%)
		<?php }else if($t->id == 465){?>
		Hipoplasia os costa 1 dan 4 kiri
		<?php }else if($t->id == 437){?>
		Skoliosis minimal vebrata torakalis
		<?php }else if($t->id == 428){?>
		Pinggang jantung menonjol
		<?php }else{ ?>
		Cor dan Pulmo tidak tampak kelainan .
		<?php } ?>
		</b></div>
	</div>
 </div>
 <div class = 'hea0' style='margin-top:50px;'>
	<div class='hea1' >
	<div style='width:110px; margin-top:70px; height:20px; border-top:1px solid; border-right:1px solid; text-align:center;  border-left:1px solid;'>
	<u>Kualifikasi</u>
	</div>
	<div style='width:110px; height:20px; border:1px solid;'>
	<?php if($t->id == 11){?>
		U : 4
		<?php }else if($t->id == 428){ ?>
		U : 4
		<?php }else if($t->id == 468){?>
		U : 2
		<?php }else if($t->id == 511 || $t->id == 425 ){?>
		U : 4
		<?php }else if($t->id == 465){?>
		U : 2
		<?php }else if($t->id == 437){?>
		U : 2
		<?php }else{ ?>
		U : 1
		<?php } ?>
	</div>
	</div>
	<div class='hea1' style='text-align:center;'>
	Yang Memeriksa<br>Dokter Unit Radiologi<br><br><br>dr. Deviasari Sp.Rad <br>SIP :445.93/0078.III.2019-DU/DPMPTSP
	</div>
 </div>
 <div class='lebih'></div>
 <?php endforeach; ?>