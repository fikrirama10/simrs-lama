<div style='width:100%; text-align:center; '>
	<div style='width:100%;'>
		<div style='width:20%; border-bottom:1px solid; padding-bottom:5px;'>
		KODIKLATAU <BR>PANGKALAN TNI AU SULAIMAN
		</div>
		
	</div>

</div>
<div class='judul-kunjungan'>
	<b>PENERIMAAN RESEP <br> BULAN <span style='text-transform: uppercase;'><?= $bulan ?></span> </b>
</div>
<div class='pengunjung'> 
	<table class='table table-bordered'>
		<tr>
			<th>No</th>
			<th>Asal Resep</th>
			<th>Dokter TNI AU</th>
			<th>Dokter Luar</th>
			<th>Paramedis</th>
			<th>Jumlah</th>
			<th>Tidak dapat dilayani</th>
		</tr>
		<tr>
			<td>1</td>
			<td>RAWAT JALAN</td>
			<td><?= $json['Rajal'] ?></td>
			<td>0</td>
			<td>0</td>
			<td><?= $json['Rajal'] ?></td>
			<td>0</td>
		</tr>
		<tr>
			<td>2</td>
			<td>RAWAT MONDOK</td>
			<td><?= $json['Mondok'] ?></td>
			<td>0</td>
			<td>0</td>
			<td><?= $json['Mondok'] ?></td>
			<td>0</td>
		</tr>
		<tr>
			<td>3</td>
			<td>LAIN - LAIN</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td></td>
			<td>Jumlah</td>
			<td><?= $json['Jumlah']?></td>
			<td>0</td>
			<td>0</td>
			<td><?= $json['Jumlah']?></td>
			<td>0</td>
		</tr>
	</table>
</div>