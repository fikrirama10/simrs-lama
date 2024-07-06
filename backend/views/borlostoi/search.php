	<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use dosamigos\chartjs\ChartJs;
use kartik\grid\GridView;
use common\models\Pasien;
use yii\helpers\Url;
$harirawat = $alos + $alos2 ;
$avlos  = $harirawat / $alos2 ;
$per = 20*$periode;
$bor = ($harirawat / $per) * 100;
$toi = ($per - $harirawat)/$alos2;
$bto = $alos2 /20;
$ndr = (0 / $alos2)*(1000/100);
// $hrr = floor($diff/86400)-242 ; 
// $borr = $bor / ($hrr * 21 )*100 ; 
// $losss = $alos / $aalos;
// $jhb = floor($diff/86400/12);
?>
    <?= $lamarawatan2 ?>
	<div class ='bor'>
	<table class ='table table-bordered'>
	<tr>
		<th>Indikator</th>
		<th>Angka</th>
		<th>Keterangan</th>
	</tr>
	<tr >
		<td width='20%'><h3>BOR</h3><a>Bed Occupancy Ratio = Angka penggunaan tempat tidur</a></td>
		<td align=middle width='30%'>
		<br>
		<h4>
		<?php if(floor($bor) >= 60){?>
		<span class="label label-success"><?=  round($bor,1) ?> %</span>
		<?php }else{?>
		<span class="label label-danger"><?=  round($bor,1) ?> %</span>
		<?php }?>
		</h4>
		<i>BOR = (Jumlah hari perawatan rumah sakit / (Jumlah tempat tidur X Jumlah hari dalam satu periode)) X 100%</i></td>
		<td width='50%'><div class="alert alert-success" role="alert">
			<p>BOR (Bed Occupancy Ratio = Angka penggunaan tempat tidur), Sedangkan menurut Depkes RI (2005), BOR adalah prosentase pemakaian tempat tidur pada satuan waktu tertentu. Indikator ini memberikan gambaran tinggi rendahnya tingkat pemanfaatan tempat tidur rumah sakit. Nilai parameter BOR yang ideal adalah antara 60-85% (Depkes RI, 2005).</p>
		</div></td>
	</tr>
	<tr >
		<td  width='20%'><h3>AVLOS</h3><a>Average Length of Stay = Rata-rata lamanya pasien dirawat</a></td>
		<td align=middle width='30%'><br>
		<h4>
		<?php if(floor($avlos) <= 9 && floor($avlos) >= 6  ){?>
		<span class="label label-success"><?=  round($avlos,1) ?> Hari</span>
		<?php }else{?>
		<span class="label label-danger"><?=  round($avlos,1) ?> Hari</span>
		<?php }?>
		</h4>
		<i>AVLOS = Jumlah lama dirawat / Jumlah pasien keluar (hidup + mati)</i></td>
		<td width='50%'><div class="alert alert-warning" role="alert">
			<p>AVLOS (Average Length of Stay = Rata-rata lamanya pasien dirawat), AVLOS menurut Depkes RI (2005) adalah rata-rata lama rawat seorang pasien. Indikator ini disamping memberikan gambaran tingkat efisiensi, juga dapat memberikan gambaran mutu pelayanan, apabila diterapkan pada diagnosis tertentu dapat dijadikan hal yang perlu pengamatan yang lebih lanjut. Secara umum nilai AVLOS yang ideal antara 6-9 hari (Depkes, 2005).</p>
		</div></td>
	</tr>
	<tr >
		<td width='20%'><h3>TOI</h3><a>Turn Over Interval = Tenggang perputaran</a></td>
		<td align=middle width='30%'><br>
		<h4>
		<?php if(floor($toi) <= 3 ){?>
		<span class="label label-success"><?=  round($toi,1) ?> Hari</span>
		<?php }else{?>
		<span class="label label-danger"><?=  round($toi,1) ?> Hari</span>
		<?php }?>
		</h4>
		</h4>
		<i>TOI = ((Jumlah tempat tidur X Periode) – Hari perawatan) / Jumlah pasien keluar (hidup +mati)</i></td>
		<td width='50%'><div class="alert alert-info" role="alert">
			<p>TOI menurut Depkes RI (2005) adalah rata-rata hari dimana tempat tidur tidak ditempati dari telah diisi ke saat terisi berikutnya. Indikator ini memberikan gambaran tingkat efisiensi penggunaan tempat tidur. Idealnya tempat tidur kosong tidak terisi pada kisaran 1-3 hari.</p>
		</div></td>
	</tr>
	<tr >
		<td width='20%'><h3>BTO</h3><a>Bed Turn Over = Angka perputaran tempat tidur</a></td>
		<td align=middle width='30%'><br>
		<h4><?=  round($bto,1) ?> Kali</h4>
		<i>BTO = Jumlah pasien keluar (hidup + mati) / Jumlah tempat tidur</i></td>
		<td width='50%'><div class="alert alert-danger" role="alert">
			<p>BTO menurut Depkes RI (2005) adalah frekuensi pemakaian tempat tidur pada satu periode, berapa kali tempat tidur dipakai dalam satu satuan waktu tertentu. Idealnya dalam satu tahun, satu tempat tidur rata-rata dipakai 40-50 kali</p>
		</div></td>
	</tr>
	</table>
	</div>
	