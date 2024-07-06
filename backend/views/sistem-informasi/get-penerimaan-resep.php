	<h4 align=center>Penerimaan Resep <br> Bulan <?= $bulan ?></h4>
	<table class='table table-bordered'>
		<tr>
			<td>No</td>
			<td>Asal Resep</td>
			<td>Dokter TNI AU</td>
			<td>Dokter Luar</td>
			<td>Paramedis</td>
			<td>Jumlah</td>
			<td>Tidak dapat dilayani</td>
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