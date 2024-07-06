<div style='width:100%; text-align:center; '>
	<div style='width:100%;'>
		<div style='width:30%; border-bottom:1px solid; padding-bottom:5px;'>
		KODIKLATAU <BR>PANGKALAN TNI AU SULAIMAN
		</div>
		
	</div>
	
	

</div>
<div class='judul-kunjungan'>
	<b>LAPORAN BULANAN <br>MACAM PENYAKIT DAN JUMLAH PENDERITA<br> RAWAT JALAN </b>
	<br>  <?= $title ?>
</div>
<div class='pengunjung'>
				<table class='table table-bordered' style='text-align:center;'>
		<tr >
			<th align=center rowspan="2">No</th>
			<th align=center rowspan="2" width=400>Nama Penyakit</th>
			<th align=center rowspan="2" width=100>ICD X</th>

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
		<?php $no=1;  for($a=0; $a < count($json); $a++){ ?>
		<tr>
			<td><?=  $no++	?></td>
			<td align=left ><?=  $json[$a]['Nama']	?></td>
			<td><?=  $json[$a]['IcdX']	?></td>
			<td><?=  $json[$a]['TniauMil']	?></td>
			<td><?=  $json[$a]['TniauSip']	?></td>
			<td><?=  $json[$a]['TniauKel']	?></td>
			
			<td><?=  $json[$a]['TniAd']	?></td>
			<td><?=  $json[$a]['TniAl']	?></td>
			
			<td><?=  $json[$a]['Bpjs']	?></td>
			<td><?=  $json[$a]['Yanmas']?></td>
			<td><?=  $json[$a]['Jumlah']?></td>
		</tr>
		<?php } ?>
	</table>
</div>