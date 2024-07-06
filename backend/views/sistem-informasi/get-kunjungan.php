		<h4 align=center>PENGUNJUNG DAN KUNJUNGAN <?= $title ?> <BR> BULAN <span style='text-transform: uppercase;'><?= $bulan ?></span></h4>  
		<table class='table table-bordered' style='text-align:center;'>
			<tr>
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
			<tr>
				<th id="navi" scope="row">Pengunjung</th>
				<!-- TNI AU -->
				<td headers="team navi win score"><?= $json['tniau']['Mil']['PengunjungMilSemua'] ?></td>			
				<td headers="team navi lost score"><?= $json['tniau']['Sip']['PengunjungSipSemua'] ?></td>
				<td headers="team navi draw score"><?= $json['tniau']['Kel']['PengunjungKelSemua'] ?></td>
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
				<td headers="team navi win score"><?= $json['Bpjs']['BpjsSemua'] ?></td>
				<td headers="team navi win score"><?= $json['Yanmas']['YanmasSemua'] ?></td>
				<td headers="team navi win score"><?= $json['Jumlah']['JumlahSemua'] ?></td>

			</tr>
			<tr>
				<th id="navi" scope="row">Kunjungan Baru</th>
				<!-- TNI AU -->
				<td headers="team navi win score"><?= $json['tniau']['Mil']['PengunjungMilBaru'] ?></td>			
				<td headers="team navi lost score"><?= $json['tniau']['Sip']['PengunjungSipBaru'] ?></td>
				<td headers="team navi draw score"><?= $json['tniau']['Kel']['PengunjungKelBaru'] ?></td>
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
				<td headers="team navi win score"><?= $json['Bpjs']['BpjsBaru'] ?></td>
				<td headers="team navi win score"><?= $json['Yanmas']['YanmasBaru'] ?></td>
				<td headers="team navi win score"><?= $json['Jumlah']['JumlahBaru'] ?></td>
				</tr>
				<tr>
				<th id="navi" scope="row">Kunjungan Ulang</th>
				<!-- TNI AU -->
				<!-- TNI AU -->
				<td headers="team navi win score"><?= $json['tniau']['Mil']['PengunjungMilLama'] ?></td>			
				<td headers="team navi lost score"><?= $json['tniau']['Sip']['PengunjungSipLama'] ?></td>
				<td headers="team navi draw score"><?= $json['tniau']['Kel']['PengunjungKelLama'] ?></td>
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
				<td headers="team navi win score"><?= $json['Bpjs']['BpjsLama'] ?></td>
				<td headers="team navi win score"><?= $json['Yanmas']['YanmasLama'] ?></td>
				<td headers="team navi win score"><?= $json['Jumlah']['JumlahLama'] ?></td>
			</tr>

		</table>