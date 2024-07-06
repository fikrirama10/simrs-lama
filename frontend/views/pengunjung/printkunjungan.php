<?php
use common\models\Pasien;
use yii\helpers\Url;

?>
<div class='header-kunjungan'>
	<div class='header-kunjungan-judul'>
		<div class="header-kunjungan-judul-au">
		KODIKLATAU <BR>PANGKALAN TNI AU SULAIMAN
		</div>
		
	</div>
	<div class='header-kunjungan-logo'>
		Lampiran VII dari Lap. Bulanan Kegiatan Rumkit Lanud Slm <br>Tanggal <?= date('d F Y')?>
	</div>

	

</div>
<div class='judul-kunjungan'>
	<b>LAPORAN BULANAN<br> PENGUNJUNG DAN KUNJUNGAN POLIKLINIK <br>BULAN <?=  $title ?></b>
</div>

				<div class='pengunjung'>
				<table width='100%'>
				<tr>
					<th align=center rowspan="2">Pengunjung / Kunjungan</th>
					
					<th colspan="3">TNI AU</th>
					<th colspan="3">TNI AD</th>
					<th colspan="3">TNI AL</th>
					<th colspan="3">POLRI</th>
					<th align=center rowspan="2">PUR</th>
					<th align=center rowspan="2">BPJS /<br> Yanmas</th>
					<th align=center rowspan="2">Jumlah</th>
				</tr>
				<tr>
					<!-- TNI AU -->
					<th scope="col">Mil</th>
					<th scope="col">Sip</th>
					<th scope="col">Kel</th>
					<!-- TNI AD -->
					<th scope="col">Mil</th>
					<th scope="col">Sip</th>
					<th scope="col">Kel</th>
					<!-- TNI AL -->
					<th scope="col">Mil</th>
					<th scope="col">Sip</th>
					<th scope="col">Kel</th>
					<!-- polri -->
					<th scope="col">Mil</th>
					<th scope="col">Sip</th>
					<th scope="col">Kel</th>
					
				</tr>
				<tr>
				<th id="navi" scope="row">Pengunjung</th>
				<!-- TNI AU -->
				<td headers="team navi win score"><?= $tniaumilall?></td>
				<td headers="team navi draw score"><?= $tniausipall?></td>
				<td headers="team navi lost score"><?= $tniaukelall?></td>
				<!-- TNI AD -->
				<td headers="team navi win score"><?= $tniadmilall?></td>
				<td headers="team navi draw score"><?= $tniadsipall?></td>
				<td headers="team navi lost score"><?= $tniadkelall?></td>
				<!-- TNI AL -->
				<td headers="team navi win score"><?= $tnialmilall?></td>
				<td headers="team navi draw score"><?= $tnialsipall?></td>
				<td headers="team navi lost score"><?= $tnialkelall?></td>
				<!-- POLRI -->
				<td headers="team navi win score"><?= $polrimilall?></td>
				<td headers="team navi draw score"><?= $polrisipall?></td>
				<td headers="team navi lost score"><?= $polrikelall?></td>
				<!-- PUR -->
				<td headers="team navi win score"><?= $pur?></td>
				<td headers="team navi win score"><?= $yanmas?></td>
				<td headers="team navi win score"><?= $jumlah?></td>
				
				</tr>
				<tr>
				<th id="navi" scope="row">Kunjungan Baru</th>
					<!-- TNI AU -->
				<td headers="team navi win score"><?= $tniaumilbaru?></td>
				<td headers="team navi draw score"><?= $tniausipbaru?></td>
				<td headers="team navi lost score"><?= $tniaukelbaru?></td>
				<!-- TNI AD -->
				<td headers="team navi win score"><?= $tniadmilbaru?></td>
				<td headers="team navi draw score"><?= $tniadsipbaru?></td>
				<td headers="team navi lost score"><?= $tniadkelbaru?></td>
				<!-- TNI AL -->
				<td headers="team navi win score"><?= $tnialmilbaru?></td>
				<td headers="team navi draw score"><?= $tnialsipbaru?></td>
				<td headers="team navi lost score"><?= $tnialkelbaru?></td>
				<!-- POLRI -->
				<td headers="team navi win score"><?= $polrimilbaru?></td>
				<td headers="team navi draw score"><?= $polrisipbaru?></td>
				<td headers="team navi lost score"><?= $polrikelbaru?></td>
					<!-- PUR -->
				<td headers="team navi win score"><?= $purbaru?></td>
				<td headers="team navi win score"><?= $yanmasbaru?></td>
				<td headers="team navi win score"><?= $jumlahbaru?></td>
				</tr>
				<tr>
				<th id="navi" scope="row">Kunjungan Ulang</th>
					<!-- TNI AU -->
					<!-- TNI AU -->
				<td headers="team navi win score"><?= $tniaumillama?></td>
				<td headers="team navi draw score"><?= $tniausiplama?></td>
				<td headers="team navi lost score"><?= $tniaukellama?></td>
				<!-- TNI AD -->
				<td headers="team navi win score"><?= $tniadmillama?></td>
				<td headers="team navi draw score"><?= $tniadsiplama?></td>
				<td headers="team navi lost score"><?= $tniadkellama?></td>
				<!-- TNI AL -->
				<td headers="team navi win score"><?= $tnialmillama?></td>
				<td headers="team navi draw score"><?= $tnialsiplama?></td>
				<td headers="team navi lost score"><?= $tnialkellama?></td>
				<!-- POLRI -->
				<td headers="team navi win score"><?= $polrimillama?></td>
				<td headers="team navi draw score"><?= $polrisiplama?></td>
				<td headers="team navi lost score"><?= $polrikellama?></td>
					<!-- PUR -->
				<td headers="team navi win score"><?= $purlama?></td>
				<td headers="team navi win score"><?= $yanmaslama?></td>
				<td headers="team navi win score"><?= $jumlahlama?></td>
				</tr>
		
				</table>
</div>

<div class='header-kunjungan'>
	<div class='ket-kunjungan'>
CATATAN
	<table>
		<tr>
			<td>KUNJUNGAN BARU</td>
			<td>:</td>
			<td>adalah pengunjung poliklinik dengan kasus baru yang datang pertamakali pada bulan ini</td>
			
		</tr>
		<tr>
		<td>KUNJUNGAN ULANG</td>
			<td>:</td>
			<td>adalah pengunjung poliklinik dengan untuk kedua kali dan seharusnya dengan kasus yang sama di bulan ini</td>
		</tr>
	</table>
	</div>
	<div class='ttd-kunjungan'>
	a.n.Komandan Pangkalan TNI AU Sulaiman
	<br>Kepala Rumah Sakit,<br><br><br><br>
	dr.Mohamad Romidon, Sp. B. FINACS<br>
	Mayor Kes NRP 529216
	</div>
</div>				
		