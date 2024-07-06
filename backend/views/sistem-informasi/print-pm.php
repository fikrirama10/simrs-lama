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
			<th align=center rowspan="2">Nama Penyakit</th>

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
		<?php $no=1; for($a=0; $a < count($json); $a++){ ?>
		<tr>
			<td><?=  $no++	?></td>
			<td><?=  $json[$a]['Nama']	?></td>
			<td><?=  $json[$a]['TniauMil']	?></td>
			<td><?=  $json[$a]['TniauSip']	?></td>
			<td><?=  $json[$a]['TniauKel']	?></td>
			
			<td>0</td>
			<td>0</td>
			
			<td><?=  $json[$a]['Bpjs']	?></td>
			<td><?=  $json[$a]['Yanmas']?></td>
			<td><?=  $json[$a]['Jumlah']?></td>
		</tr>
		<?php } ?>
	</table>
</div>