<?php 
use yii\helpers\Html;
use common\models\Mcutni;
use Picqer\Barcode\BarcodeGeneratorHTML;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
$tni = Mcutni::find()->where(['between','id',200,295])->all();
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
			<td>11/12/2019</td>
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
		<?php }else if($t->id == 251){?>
		Bifid rib os costa 5 kanan
		<?php }else if($t->id == 238){?>
		Bifid rib os costa 4 kanan
		<?php }else if($t->id == 227){?>
		Bifid rib os costa 3 kanan
		<?php }else if($t->id == 80){?>
		Microcardia (CTR 31%)
		<?php }else if($t->id == 226){ ?>
		Fibrokalsifikasi minimal di lapang atas<br> pulmo kanan
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
		<?php }else if($t->id == 40){ ?>
		U : 4
		<?php }else if($t->id == 66){?>
		U : 4
		<?php }else if($t->id == 238 || $t->id == 227){?>
		U : 2
		<?php }else if($t->id == 251){?>
		U : 2
		<?php }else if($t->id == 226){?>
		U : 3
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