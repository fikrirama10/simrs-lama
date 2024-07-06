<div style='width:100%; text-align:center; '>
	<div style='width:100%;'>
		<div style='width:20%; border-bottom:1px solid; padding-bottom:5px;'>
		KODIKLATAU <BR>PANGKALAN TNI AU SULAIMAN
		</div>
		
	</div>

</div>
<div class='judul-kunjungan'>
	<b>KEGIATAN UNIT GAWAT DARURAT <br> BULAN <span style='text-transform: uppercase;'><?= $bulan ?></span> </b>
</div> 
<div class='pengunjung'> 
	<table>
		<tr>
			<th rowspan="2">No</th>
			<th rowspan="2">Asal Resep</th>
			<th colspan="4">Tindak Lanjut</th>
			<th rowspan="2">Jumlah</th>
			<th rowspan="2">Keterangan</th>
		</tr>
			
		<tr>
			<th>Dirawat</th>
			<th>Dirujuk</th>
			<th>Pulang</th>
			<th>Meninggal</th>
		</tr>
		
		<tr>
			<td>1</td>
			<td>Bedah</td>
			<td><?= $json['Bedah']['Rawat'] ?></td>
			<td><?= $json['Bedah']['Rujuk'] ?></td>
			<td><?= $json['Bedah']['Pulang'] ?></td>
			<td><?= $json['Bedah']['Meninggal'] ?></td>
			<td><?= $json['JumlahBedah'] ?></td>
			<td></td>
		</tr>
		<tr>
			<td>2</td>
			<td>Non Bedah</td>
			<td><?= $json['NonBedah']['Rawat'] ?></td>
			<td><?= $json['NonBedah']['Rujuk'] ?></td>
			<td><?= $json['NonBedah']['Pulang'] ?></td>
			<td><?= $json['NonBedah']['Meninggal'] ?></td>
			<td><?= $json['JumlahNonBedah'] ?></td>
			<td></td>
		</tr>
		
		<tr>
			<td>3</td>
			<td>Lain Lain</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td></td>
		</tr>
		
		<tr>
			<td></td>
			<td>Jumlah</td>
			<td><?= $json['JumlahRawat'] ?></td>
			<td><?= $json['JumlahRujuk'] ?></td>
			<td><?= $json['JumlahPulang'] ?></td>
			<td><?= $json['JumlahMeninggal'] ?></td>
			<td><?= $json['Jumlah'] ?></td>
			<td></td>
		</tr>
	</table>
</div>