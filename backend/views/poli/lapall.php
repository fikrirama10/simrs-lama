<?php

?>
<div style='width:100%; text-align:center; '>
	<div style='width:100%;'>
		<div style='width:20%; border-bottom:1px solid; padding-bottom:5px;'>
		KODIKLATAU <BR>PANGKALAN TNI AU SULAIMAN
		</div>
		
	</div>
	
	

</div>
<div class='judul-kunjungan'>
	<b>PENGUNJUNG DAN KUNJUNGAN POLIKLINIK SPESIALIS<br> BULAN <?= Yii::$app->algo->tglIndobuk($dalam['Bulan']);?> Tahun <?= $dalam['Tahun'] ?> </b>
</div>
<div class='pengunjung'>
			<table class='table table-bordered' style='text-align:center;'>
				<tr>
					
					<th align=center rowspan="4">No</th>
					<th align=center width=220 rowspan="4">Jenis Pelayanan Rawat Jalan</th>				
					<th align=center colspan="24">Kunjungan Baru / Ulang</th>
					<th align=center rowspan="3" colspan="2">BPJS </th>
					<th align=center rowspan="3" colspan="2">Yanmas</th>
					<th align=center rowspan="3" colspan="2">Jumlah</th>
					<th align=center rowspan="3">Total</th>
				
					
				</tr>
				<tr>
					<th scope="col" colspan="6">AU</th>
					<th scope="col" colspan="6">AD</th>
					<th scope="col" colspan="6">AL</th>
					<th scope="col" colspan="6">POLISI</th>
				</tr>
				<tr>
					<!-- TNI AU -->
					<th scope="col" colspan="2">Mil</th>
					<th scope="col" colspan="2">Sip</th>
					<th scope="col" colspan="2">Kel</th>
					<!-- TNI AD -->
					<th scope="col" colspan="2">Mil</th>
					<th scope="col" colspan="2">Sip</th>
					<th scope="col" colspan="2">Kel</th>
					<!-- TNI AL -->
					<th scope="col" colspan="2">Mil</th>
					<th scope="col" colspan="2">Sip</th>
					<th scope="col" colspan="2">Kel</th>
					<!-- polri -->
					<th scope="col" colspan="2">Mil</th>
					<th scope="col" colspan="2">Sip</th>
					<th scope="col" colspan="2">Kel</th>
					
				</tr>
				<tr>
					
					
					<th scope="col">B</th>
					<th scope="col">L</th>
					
					<th scope="col">B</th>
					<th scope="col">L</th>
					
					<th scope="col">B</th>
					<th scope="col">L</th>
					
					<th scope="col">B</th>
					<th scope="col">L</th>
					
					
					<th scope="col">B</th>
					<th scope="col">L</th>
					
					<th scope="col">B</th>
					<th scope="col">L</th>
					
					<th scope="col">B</th>
					<th scope="col">L</th>
					
					<th scope="col">B</th>
					<th scope="col">L</th>
					
					<th scope="col">B</th>
					<th scope="col">L</th>
					
					<th scope="col">B</th>
					<th scope="col">L</th>
					
					<th scope="col">B</th>
					<th scope="col">L</th>
					
					<th scope="col">B</th>
					<th scope="col">L</th>
					
					<th scope="col">B</th>
					<th scope="col">L</th>
					
					<th scope="col">B</th>
					<th scope="col">L</th>
					
					<th scope="col">B</th>
					<th scope="col">L</th>
					
					<th scope="col"></th>
				</tr>
				<tr>
					<td>1</td>
					<td>Penyakait Dalam</td>
					<!-- TNI AU -->
					<td><?= $dalam['tniau']['Mil']['PengunjungMilBaru'] ?></td>
					<td><?= $dalam['tniau']['Mil']['PengunjungMilLama'] ?></td>
					<td><?= $dalam['tniau']['Sip']['PengunjungSipBaru'] ?></td>
					<td><?= $dalam['tniau']['Sip']['PengunjungSipLama'] ?></td>				
					<td><?= $dalam['tniau']['Kel']['PengunjungKelBaru'] ?></td>
					<td><?= $dalam['tniau']['Kel']['PengunjungKelLama'] ?></td>
					<!-- TNI AD -->
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>					
					<!-- TNI AL -->
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					
					<!-- POLISI -->
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					
					<td><?= $dalam['Bpjs']['BpjsBaru'] ?></td>
					<td><?= $dalam['Bpjs']['BpjsLama'] ?></td>
										
					<td><?= $dalam['Yanmas']['YanmasBaru'] ?></td>
					<td><?= $dalam['Yanmas']['YanmasLama'] ?></td>
					
					<td><?= $dalam['Jumlah']['JumlahBaru']  ?></td>
					<td><?= $dalam['Jumlah']['JumlahLama']  ?></td>
					
					<td><?= $dalam['Jumlah']['JumlahSemua']  ?></td>
					
				</tr>
				<tr>
					<td>2</td>
					<td>Bedah</td>
					<!-- TNI AU -->
					<td><?= $bedah['tniau']['Mil']['PengunjungMilBaru'] ?></td>
					<td><?= $bedah['tniau']['Mil']['PengunjungMilLama'] ?></td>
					<td><?= $bedah['tniau']['Sip']['PengunjungSipBaru'] ?></td>
					<td><?= $bedah['tniau']['Sip']['PengunjungSipLama'] ?></td>				
					<td><?= $bedah['tniau']['Kel']['PengunjungKelBaru'] ?></td>
					<td><?= $bedah['tniau']['Kel']['PengunjungKelLama'] ?></td>
					<!-- TNI AD -->
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>					
					<!-- TNI AL -->
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					
					<!-- POLISI -->
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					
					<td><?= $bedah['Bpjs']['BpjsBaru'] ?></td>
					<td><?= $bedah['Bpjs']['BpjsLama'] ?></td>
										
					<td><?= $bedah['Yanmas']['YanmasBaru'] ?></td>
					<td><?= $bedah['Yanmas']['YanmasLama'] ?></td>
					
					<td><?= $bedah['Jumlah']['JumlahBaru']  ?></td>
					<td><?= $bedah['Jumlah']['JumlahLama']  ?></td>
					<td><?= $bedah['Jumlah']['JumlahSemua']  ?></td>
					
				</tr>
				<tr>
					<td>3</td>
					<td>Anak</td>
					<!-- TNI AU -->
					<td><?= $anak['tniau']['Mil']['PengunjungMilBaru'] ?></td>
					<td><?= $anak['tniau']['Mil']['PengunjungMilLama'] ?></td>
					<td><?= $anak['tniau']['Sip']['PengunjungSipBaru'] ?></td>
					<td><?= $anak['tniau']['Sip']['PengunjungSipLama'] ?></td>				
					<td><?= $anak['tniau']['Kel']['PengunjungKelBaru'] ?></td>
					<td><?= $anak['tniau']['Kel']['PengunjungKelLama'] ?></td>
					<!-- TNI AD -->
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>					
					<!-- TNI AL -->
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					
					<!-- POLISI -->
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					
					<td><?= $anak['Bpjs']['BpjsBaru'] ?></td>
					<td><?= $anak['Bpjs']['BpjsLama'] ?></td>
										
					<td><?= $anak['Yanmas']['YanmasBaru'] ?></td>
					<td><?= $anak['Yanmas']['YanmasLama'] ?></td>
					
					<td><?= $anak['Jumlah']['JumlahBaru']  ?></td>
					<td><?= $anak['Jumlah']['JumlahLama']  ?></td>
					<td><?= $anak['Jumlah']['JumlahSemua']  ?></td>
					
				</tr>
					<tr>
					<td>4</td>
					<td>Obgyn</td>
					<!-- TNI AU -->
					<td><?= $kandungan['tniau']['Mil']['PengunjungMilBaru'] ?></td>
					<td><?= $kandungan['tniau']['Mil']['PengunjungMilLama'] ?></td>
					<td><?= $kandungan['tniau']['Sip']['PengunjungSipBaru'] ?></td>
					<td><?= $kandungan['tniau']['Sip']['PengunjungSipLama'] ?></td>				
					<td><?= $kandungan['tniau']['Kel']['PengunjungKelBaru'] ?></td>
					<td><?= $kandungan['tniau']['Kel']['PengunjungKelLama'] ?></td>
					<!-- TNI AD -->
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>					
					<!-- TNI AL -->
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					
					<!-- POLISI -->
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					
					<td><?= $kandungan['Bpjs']['BpjsBaru'] ?></td>
					<td><?= $kandungan['Bpjs']['BpjsLama'] ?></td>
										
					<td><?= $kandungan['Yanmas']['YanmasBaru'] ?></td>
					<td><?= $kandungan['Yanmas']['YanmasLama'] ?></td>
					
					<td><?= $kandungan['Jumlah']['JumlahBaru']  ?></td>
					<td><?= $kandungan['Jumlah']['JumlahLama']  ?></td>
					<td><?= $kandungan['Jumlah']['JumlahSemua']  ?></td>
					
				</tr>
					<tr>
					<td>5</td>
					<td>Gigi</td>
					<!-- TNI AU -->
					<td><?= $gigi['tniau']['Mil']['PengunjungMilBaru'] ?></td>
					<td><?= $gigi['tniau']['Mil']['PengunjungMilLama'] ?></td>
					<td><?= $gigi['tniau']['Sip']['PengunjungSipBaru'] ?></td>
					<td><?= $gigi['tniau']['Sip']['PengunjungSipLama'] ?></td>				
					<td><?= $gigi['tniau']['Kel']['PengunjungKelBaru'] ?></td>
					<td><?= $gigi['tniau']['Kel']['PengunjungKelLama'] ?></td>
					<!-- TNI AD -->
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>					
					<!-- TNI AL -->
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					
					<!-- POLISI -->
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					
					<td><?= $gigi['Bpjs']['BpjsBaru'] ?></td>
					<td><?= $gigi['Bpjs']['BpjsLama'] ?></td>
										
					<td><?= $gigi['Yanmas']['YanmasBaru'] ?></td>
					<td><?= $gigi['Yanmas']['YanmasLama'] ?></td>
					
					<td><?= $gigi['Jumlah']['JumlahBaru']  ?></td>
					<td><?= $gigi['Jumlah']['JumlahLama']  ?></td>
					<td><?= $gigi['Jumlah']['JumlahSemua']  ?></td>
					
				</tr>
				
					<tr>
					<td></td>
					<td><b>Total</b></td>
					<!-- TNI AU -->
					<td><?= $milbaru ?></td>
					<td><?= $millama ?></td>
					<td><?= $sipbaru ?></td>
					<td><?= $siplama ?></td>
					<td><?= $kelbaru ?></td>
					<td><?= $kellama ?></td>	
					
					<!-- TNI AD -->
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>					
					<!-- TNI AL -->
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					
					<!-- POLISI -->
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td> 
					
					<td><?= $bpjsbaru ?></td>
					<td><?= $bpjslama ?></td>
					<td><?= $yanmasbaru ?></td>
					<td><?= $yanmaslama ?></td>
					<td><?= $jumlahbaru ?></td>
					<td><?= $jumlahlama ?></td>
					<td><?= $semua ?></td>
					
				</tr>
		
				</table>
</div>