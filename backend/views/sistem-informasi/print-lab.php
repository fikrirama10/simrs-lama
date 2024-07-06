<div style='width:100%; text-align:center; '>
	<div style='width:100%;'>
		<div style='width:30%; border-bottom:1px solid; padding-bottom:5px;'>
		KODIKLATAU <BR>PANGKALAN TNI AU SULAIMAN
		</div>
		
	</div>
	
	

</div>
<div class='judul-kunjungan'>
	<b>LAPORAN BULANAN <br>PEMERIKSAAN PATOLOGI KLINIK </b>
	<br>  <?= $title ?>
</div>
<div class='pengunjung'>
		<table class='table table-bordered'>

				<tr>  
					<th rowspan="2" align=center>NO</th>
					<th rowspan="2" width=300 >JENIS PEMERIKSAAN</th>
					<th colspan="3">TNI AU</th>
					<th colspan="3">TNI AD</th>
					<th colspan="3">TNI AL</th>
					<th align=center rowspan="2">BPJS </th>
					<th align=center rowspan="2">Yanmas</th>
					<th align=center rowspan="2">Jumlah</th>
				</tr>
				<tr>
					<!-- TNI AU -->
					<th scope="col">MIL</th>
					<th scope="col">SIP</th>
					<th scope="col">KEL</th>
					<!-- TNI AD -->
					<th scope="col">MIL</th>
					<th scope="col">SIP</th>
					<th scope="col">KEL</th>
					<!-- TNI AL -->
					<th scope="col">MIL</th>
					<th scope="col">SIP</th>
					<th scope="col">KEL</th>
					
				</tr>
				
				<?php $no=1;  for($a=0; $a < count($json); $a++){ ?>
						<tr>			
							<td><?= $no++ ?></td>
							<td><?= $json[$a]['Nama'] ?></td>
							<td><?= $json[$a]['TniauMil'] ?></td>
							<td><?= $json[$a]['TniauSip'] ?></td>
							<td><?= $json[$a]['TniauKel'] ?></td>
							
							<td>0</td>
							<td>0</td>
							<td>0</td>
							
							<td>0</td>
							<td>0</td>
							<td>0</td>
							
							<td><?= $json[$a]['Bpjs'] ?></td>
							<td><?= $json[$a]['Yanmas'] ?></td>
							<td><?= $json[$a]['Jumlah'] ?></td>		
						</tr>
				<?php } ?>
		</table>
</div>