<div  class="trx" style="font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
	<div class='header-kunjungan'>
	<div class='header-kunjungan-judul'>
		<div class="header-kunjungan-judul-au">
		PANGKALAN TNI AU SULAIMAN <br> RUMAH SAKIT
		</div>
		
	</div>
	

</div>
<div class='judul-kunjungan'>
	<b>LAPORAN HARIAN<br> APOTEK YANMAS <?= $awal ?></b>
	</div>
			<table>	
				<tr>
					<th>No</th>
					<th>IdObat</th>
					<th>Nama Obat</th>
					<th>Stok Awal</th>		
					<th>Stok Masuk</th>
					<th>Stok Keluar</th>
					<th>Stok / Sisa</th>
						
				</tr>
			
					<?php 
					if(count($stokyanmas) > 0){
						$no = 1;
						foreach($stokyanmas as $sy){
													
					?>
					<input type="hidden" id="trxid" value="<?= $sy->id ?>">
					<tr>
								<td><?=  $no++ ?> </td>
								<td><?=  $sy->idobat ?> </td>
								<td><?=  $sy->obat->namaobat ?> (<?= $sy->obat->jenis->jenisbayar ?>) </td>
								<td><?=  $sy->stokawal ?> </td>
								<td><?=  $sy->stokmasuk ?> </td>
								<td><?=  $sy->stokkeluar ?> </td>
								<td><?=  $sy->stokakhir ?> </td>
					</tr>
					<?php 
						}
						
						}
						
					else{
					?>
					<tr>
						<td colspan=7><div class="empty">No result found.</div></td>
					</tr>
					<?php } ?>
			
			</table>
			
		
			
	</div>
</div>
