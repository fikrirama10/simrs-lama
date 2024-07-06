<div  class="trx" style="font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
	<div class='header-kunjungan'>
	<div class='header-kunjungan-judul'>
		<div class="header-kunjungan-judul-au">
		PANGKALAN TNI AU SULAIMAN<br>
		RUMAH SAKIT
		</div>
		
	</div>
	

</div>
<div class='judul-kunjungan'>
	<b>LAPORAN BULANAN<br> APOTEK <?= $title ?> </b><br>
	<?= $tanggal ?>
	</div>
			<table>	
				<tr>
					<th>No</th>
					<th>Nama Obat</th>
					<th>Stok Awal</th>		
					<th>Stok Masuk</th>
					<th>Stok Keluar</th>
					<th>Stok / Sisa</th>
					<th>Harga Satuan</th>
					<th>Total</th>
						
				</tr>
			
					<?php $total=0; $no1=1;  for($a=0; $a < count($json); $a++){ ?>
						<tr>
							<td><?= $no1++ ?></td>
							<td><?=  $json[$a]['namaobat']	?></td>
							<td><?=  $json[$a]['awal']	?></td>
							<td><?=  $json[$a]['masuk']	?></td>
							<td><?=  $json[$a]['keluar']	?></td>
							<td><?=  $json[$a]['akhir']	?></td>
								<td><?=  $json[$a]['harga']	?></td>
								<td><?=  $json[$a]['harga']*$json[$a]['akhir']	?></td>
						</tr>
						<?php $total += $json[$a]['harga']*$json[$a]['akhir']; ?>
						<?php } ?>
							<tr>
                    	    <td colspan=7>Total</td>
	                        <td>Rp. <?=  Yii::$app->algo->IndoCurr($total) ?></td>
                        	</tr>
					
			
			</table>
			
		
			
	</div>
</div>
<br>
<br>
<div style='width:50%; text-indent:80px; font-size:15px; float:left; text-align:center;'>APOTEKER
     <br><br><br><br>
    ANITA SARI ,S.Farm.,Apt<br> SIPA:440/0148.XII.2018/APT/DPMPTSP
</div>

<div style='width:50%; text-indent:80px; font-size:15px; float:right; text-align:center;'>Bandung , 31 	<?= $tanggal2 ?> <br> Penanggung Jawab IFRS <br><br><br><br>
    RINI HARYATI<br> PNS II/D NIP .198207022010122002
</div>