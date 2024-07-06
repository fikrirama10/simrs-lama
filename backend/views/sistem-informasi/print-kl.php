<div style='width:100%; text-align:center; '>
	<div style='width:100%;'>
		<div style='width:20%; border-bottom:1px solid; padding-bottom:5px;'>
		KODIKLATAU <BR>PANGKALAN TNI AU SULAIMAN
		</div>
		
	</div>

</div>
<div class='judul-kunjungan'>
	<b>JUMLAH KELAHIRAN DAN KEMATIAN IBU KARENA MELAHIRKAN <br> BULAN <span style='text-transform: uppercase;'><?= $bulan ?></span> </b>
</div>
<div class='pengunjung'> 
	<table class='table table-bordered'>
		<tr >
			<th align=center rowspan="2">No</th>
			<th align=center colspan="2" rowspan="2">Jenis Kelahiran</th>

			<th colspan="3">TNI AU</th>
			<th colspan="2">Angkatan Lain</th>
			<th align=center rowspan="2">BPJS </th>
			<th align=center rowspan="2">Yanmas</th>
			<th align=center rowspan="2">Jumlah</th>
		</tr>
		<tr>
			<th scope="col">Mil</th>
			<th scope="col">Sip</th>
			<th scope="col">Kel</th>
			<th scope="col">AD</th>
			<th scope="col">AL</th>
		</tr>
		<tr>
			<td rowspan="2">1</td>
			<td rowspan="2">Kelahiran Normal</td>			
			<td scope="col">Mati</td>
			<td scope="col"><?= $json['tniau']['Mil']['NormalMati'] ?></td>
			<td scope="col"><?= $json['tniau']['Sip']['NormalMati'] ?></td>
			<td scope="col"><?= $json['tniau']['Kel']['NormalMati'] ?></td>
			<td scope="col">0</td>
			<td scope="col">0</td>
			<td scope="col"><?= $json['Bpjs']['NormalMati'] ?></td>
			<td scope="col"><?= $json['Yanmas']['NormalMati'] ?></td>
			<td scope="col"><?= $json['Jumlah']['NormalMati'] ?></td>
		</tr>
		<tr>
			<td scope="col">Hidup</td>			
			<td scope="col"><?= $json['tniau']['Mil']['NormalHidup'] ?></td>
			<td scope="col"><?= $json['tniau']['Sip']['NormalHidup'] ?></td>
			<td scope="col"><?= $json['tniau']['Kel']['NormalHidup'] ?></td>
			<td scope="col">0</td>
			<td scope="col">0</td>
			<td scope="col"><?= $json['Bpjs']['NormalHidup'] ?></td>
			<td scope="col"><?= $json['Yanmas']['NormalHidup'] ?></td>
			<td scope="col"><?= $json['Jumlah']['NormalHidup'] ?></td>	
		</tr>
		
		<tr>
			<td rowspan="2">2</td>
			<td rowspan="2">Kelahiran SC</td>			
			<td scope="col">Mati</td>
			<td scope="col"><?= $json['tniau']['Mil']['ScMati'] ?></td>
			<td scope="col"><?= $json['tniau']['Sip']['ScMati'] ?></td>
			<td scope="col"><?= $json['tniau']['Kel']['ScMati'] ?></td>
			<td scope="col">0</td>
			<td scope="col">0</td>
			<td scope="col"><?= $json['Bpjs']['ScMati'] ?></td>
			<td scope="col"><?= $json['Yanmas']['ScMati'] ?></td>
			<td scope="col"><?= $json['Jumlah']['ScMati'] ?></td>
		</tr>
		<tr>
			<td scope="col">Hidup</td>			
			<td scope="col"><?= $json['tniau']['Mil']['ScHidup'] ?></td>
			<td scope="col"><?= $json['tniau']['Sip']['ScHidup'] ?></td>
			<td scope="col"><?= $json['tniau']['Kel']['ScHidup'] ?></td>
			<td scope="col">0</td>
			<td scope="col">0</td>
			<td scope="col"><?= $json['Bpjs']['ScHidup'] ?></td>
			<td scope="col"><?= $json['Yanmas']['ScHidup'] ?></td>
			<td scope="col"><?= $json['Jumlah']['ScHidup'] ?></td>	
		</tr>
		
		<tr>
			<td rowspan="2">3</td>
			<td colspan="2">Kematian Ibu Karena Melahirkan</td>			
			<td scope="col"><?= $json['tniau']['Mil']['IbuMeninggal'] ?></td>
			<td scope="col"><?= $json['tniau']['Sip']['IbuMeninggal'] ?></td>
			<td scope="col"><?= $json['tniau']['Kel']['IbuMeninggal'] ?></td>
			<td scope="col">0</td>
			<td scope="col">0</td>
			<td scope="col"><?= $json['Bpjs']['IbuMeninggal'] ?></td>
			<td scope="col"><?= $json['Yanmas']['IbuMeninggal'] ?></td>
			<td scope="col"><?= $json['Jumlah']['IbuMeninggal'] ?></td>
		</tr>
		
	</table>
</div>