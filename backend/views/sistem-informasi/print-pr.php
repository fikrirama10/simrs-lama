<div style='width:100%; text-align:center; '>
	<div style='width:100%;'>
		<div style='width:20%; border-bottom:1px solid; padding-bottom:5px;'>
		KODIKLATAU <BR>PANGKALAN TNI AU SULAIMAN
		</div>
		
	</div>
	
	

</div>
<div class='judul-kunjungan'>
	<b>LAPORAN BULANAN <br>PELAYANAN RAWAT INAP</b>
	<br>  <?= $title ?>
</div>
<div class='pengunjung'>
<table class='table table-responsive-md table-bordered' style='text-align:center;'>
	<tr>
		
		<th align=center rowspan="4">No</th>
		<th align=center width=220 rowspan="4">Macam Penyakit </th>				
		<th align=center colspan="18">JUMLAH PENDERITA/JUMLAH HARI RAWAT</th>
		<th align=center rowspan="3" colspan="2">BPJS </th>
		<th align=center rowspan="3" colspan="2">Yanmas</th>
		<th align=center rowspan="3" colspan="2">Jumlah</th>
	
		
	</tr>
	<tr>
		<th scope="col" colspan="6">AU</th>
		<th scope="col" colspan="6">AD</th>
		<th scope="col" colspan="6">AL</th>
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
		
	</tr>
	<tr>
		
		
		<th scope="col">OR</th>
		<th scope="col">HR</th>
		
		<th scope="col">OR</th>
		<th scope="col">HR</th>
		
		<th scope="col">OR</th>
		<th scope="col">HR</th>
		
		<th scope="col">OR</th>
		<th scope="col">HR</th>
		
		
		<th scope="col">OR</th>
		<th scope="col">HR</th>
		
		<th scope="col">OR</th>
		<th scope="col">HR</th>
		
		<th scope="col">OR</th>
		<th scope="col">HR</th>
		
		<th scope="col">OR</th>
		<th scope="col">HR</th>
		
		<th scope="col">OR</th>
		<th scope="col">HR</th>
		
		<th scope="col">OR</th>
		<th scope="col">HR</th>
		
		<th scope="col">OR</th>
		<th scope="col">HR</th>
		
		<th scope="col">OR</th>
		<th scope="col">HR</th>
		
	</tr>
	
	<?php $no=1; for($a=0; $a < count($json); $a++){ ?>
		<tr>
			<td><?=  $no++	?></td>
			<td><?=  $json[$a]['Nama']	?></td>
			
			<td><?=  $json[$a]['TniAu']['Mil']	?></td>
			<td><?=  $json[$a]['TniAu']['MilHr']	?></td>
			<td><?=  $json[$a]['TniAu']['Sip']	?></td>
			<td><?=  $json[$a]['TniAu']['SipHr']	?></td>
			<td><?=  $json[$a]['TniAu']['Kel']	?></td>
			<td><?=  $json[$a]['TniAu']['Kelhr']	?></td>
			
			<td><?=  $json[$a]['TniAd']['Mil']	?></td>
			<td><?=  $json[$a]['TniAd']['MilHr']	?></td>
			<td><?=  $json[$a]['TniAd']['Sip']	?></td>
			<td><?=  $json[$a]['TniAd']['SipHr']	?></td>
			<td><?=  $json[$a]['TniAd']['Kel']	?></td>
			<td><?=  $json[$a]['TniAd']['Kelhr']	?></td>
			
			<td><?=  $json[$a]['TniAl']['Mil']	?></td>
			<td><?=  $json[$a]['TniAl']['MilHr']	?></td>
			<td><?=  $json[$a]['TniAl']['Sip']	?></td>
			<td><?=  $json[$a]['TniAl']['SipHr']	?></td>
			<td><?=  $json[$a]['TniAl']['Kel']	?></td>
			<td><?=  $json[$a]['TniAl']['Kelhr']	?></td>
			

			<td><?=  $json[$a]['Bpjs']['Jumlah']	?></td>
			<td><?=  $json[$a]['Bpjs']['Hr']	?></td>
			<td><?=  $json[$a]['Yanmas']['Jumlah']	?></td>
			<td><?=  $json[$a]['Yanmas']['Hr']	?></td>
			
			<td><?=  $json[$a]['Jumlah']['Jumlah']	?></td>
			<td><?=  $json[$a]['Jumlah']['Hr']	?></td>
		</tr>
		<?php } ?>
	
</table>
</div>