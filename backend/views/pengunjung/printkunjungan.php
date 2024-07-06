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
	
	

</div>
<div class='judul-kunjungan'>
	<b>LAPORAN BULANAN<br> KUNJUNGAN  <?= $title?></b>
</div>

				<div class='pengunjung'>
				<table class='table table-bordered' style='text-align:center;'>
				<tr >
					<th align=center rowspan="2">Pengunjung / Kunjungan</th>
					
					<th colspan="3">TNI AU</th>
					<th colspan="3">TNI AD</th>
					<th colspan="3">TNI AL</th>
					<th colspan="3">POLRI</th>
					<th align=center rowspan="2">BPJS </th>
					<th align=center rowspan="2">Yanmas</th>
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
					<tr >
					<th align=center rowspan="2">1</th>
					
					
					
				</tr>
				<tr>
					<!-- TNI AU -->
					<th scope="col">2</th>
					<th scope="col">3</th>
					<th scope="col">4</th>
					<!-- TNI AD -->
					<th scope="col">5</th>
					<th scope="col">6</th>
					<th scope="col">7</th>
					<!-- TNI AL -->
					<th scope="col">8</th>
					<th scope="col">9</th>
					<th scope="col">10</th>
					<!-- polri -->
					<th scope="col">11</th>
					<th scope="col">12</th>
					<th scope="col">13</th>
					<th scope="col">14</th>
					<th scope="col">15</th>
					<th scope="col">16</th>
					
				</tr>
				<tr>
				<th id="navi" scope="row">Pengunjung</th>
				<!-- TNI AU -->
				<td headers="team navi win score"><?= $ausemua?></td>
				<td headers="team navi draw score"><?= $pnstni ?></td>
				<td headers="team navi lost score"><?= $kelausemua?></td>
				<!-- TNI AD -->
				<td headers="team navi win score">0</td>
				<td headers="team navi draw score">0</td>
				<td headers="team navi lost score">0</td>
				<!-- TNI AL -->
				<td headers="team navi win score">0</td>
				<td headers="team navi draw score">0</td>
				<td headers="team navi lost score">0</td>
				<!-- POLRI -->
				<td headers="team navi win score">0</td>
				<td headers="team navi draw score">0</td>
				<td headers="team navi lost score">0</td>
				<!-- PUR -->
				<td headers="team navi win score"><?= $bpjs?></td>
				<td headers="team navi win score"><?= $yanmas?></td>
				<td headers="team navi win score"><?= $semua?></td>
				
				</tr>
				<tr>
				<th id="navi" scope="row">Kunjungan Baru</th>
					<!-- TNI AU -->
				<td headers="team navi win score"><?= $aubaru?></td>
				<td headers="team navi draw score">29</td>
				<td headers="team navi lost score"><?= $kelaubaru?></td>
				<!-- TNI AD -->
				<td headers="team navi win score">0</td>
				<td headers="team navi draw score"><?= $tniadsipbaru?></td>
				<td headers="team navi lost score"><?= $tniadkelbaru?></td>
				<!-- TNI AL -->
				<td headers="team navi win score"><?= $tnialmilbaru?></td>
				<td headers="team navi draw score"><?= $tnialsipbaru?></td>
				<td headers="team navi lost score"><?= $tnialkelbaru?></td>
				<!-- POLRI -->
				<td headers="team navi win score">0</td>
				<td headers="team navi draw score"><?= $polrisipbaru?></td>
				<td headers="team navi lost score"><?= $polrikelbaru?></td>
					<!-- PUR -->
				<td headers="team navi win score"><?= $bpjsbaru ?></td>
				<td headers="team navi win score"><?= $yanmasbaru?></td>
				<td headers="team navi win score"><?= $semuabaru?></td>
				</tr>
				<tr>
				<th id="navi" scope="row">Kunjungan Ulang</th>
					<!-- TNI AU -->
					<!-- TNI AU -->
				<td headers="team navi win score"><?= $aulama?></td>
				<td headers="team navi draw score">38</td>
				<td headers="team navi lost score"><?= $kelaulama?></td>
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
				<td headers="team navi win score"><?= $bpjslama?></td>
				<td headers="team navi win score"><?= $yanmaslama?></td>
				<td headers="team navi win score"><?= $semualama?></td>
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
	dr.Yahya Nurlianto Sp.OG<br>
	Kapten Kes NRP 537285
	</div>
</div>			
				<div class='pengunjung'>
				<table class='table table-bordered' style='text-align:center;'>
				<tr >
					<th align=center rowspan="2">Pengunjung / Kunjungan</th>
					
					<th colspan="5">Jumlah pasien Rawatjalan </th>
					<th colspan="5">Jumlah pasien Rawat Inap</th>
				</tr>
				<tr>
					<!-- TNI AU -->
					<th scope="col">TNI</th>
					<th scope="col">PNS</th>
					<th scope="col">Keluaga</th>
					<th scope="col">Purn</th>
					<th scope="col">Masyarakat Umum</th>
					<!-- TNI AD -->
					<th scope="col">TNI</th>
					<th scope="col">PNS</th>
					<th scope="col">Keluaga</th>
					<th scope="col">Purn</th>
					<th scope="col">Masyarakat Umum</th>
					<!-- TNI AL -->
					
				</tr>
				
				<tr>
				<th id="navi" scope="row">Pengunjung</th>
				<!-- TNI AU -->
				<td headers="team navi win score"><?= $patni?></td>
				<td headers="team navi draw score"><?= $ppns?></td>
				<td headers="team navi lost score"><?= $pakel?></td>
				<!-- TNI AD -->
				<td headers="team navi win score"><?= $papurn?></td>
				<td headers="team navi draw score"><?= $pmu?></td>
				<td headers="team navi lost score"><?=$tniri?></td>
				<!-- TNI AL -->
				<td headers="team navi win score"><?=$ppnsri?></td>
				<td headers="team navi draw score">10</td>
				<td headers="team navi lost score"><?= $ppurnri?></td>
				<!-- POLRI -->
				<td headers="team navi win score"><?= $muri?></td>
				
				
				</tr>
				
				</tr>
		
				</table>
</div>	
		