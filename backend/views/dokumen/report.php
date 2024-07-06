<?php

use yii\helpers\Html;
use yii\grid\GridView;

?>
<div class="trx" style="font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
	<div class='header-kunjungan'>
	<div class='header-kunjungan-judul'>
		<div class="header-kunjungan-judul-au">
		PANGKALAN TNI AU SULAIMAN<br>RUMAH SAKIT
		</div>
		
	</div>
	

</div>
<div class='judul-kunjungan'><br>
	<b>DAFTAR REFERENSI</b>
	</div>
<br>
		
			<table>
				
					<tr style="background:#f0f0f0">
						<th>#</th>
						<th>Kode Dokumen</th>
						<th>Judul Dokumen</th>
						<th>Jenis Dokumen</th>
						<th>Kategori Dokumen</th>
						<th>Tanggal Upload</th>
						
					</tr>
				
				
					<?php 
					if(count($dataProvider) > 0){
						$no = 1;
						foreach($dataProvider as $data){
													
					?>
					
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $data->Kode?></td>
						<td><?= $data->Judul?></td>
						<td><?= $data->jenis->Jenis?></td>
						<td><?= $data->kategori->Kategori?></td>
						<td><?= $data->PublishDate?></td>
					</tr>
					<?php 
						}
						
					}else{
					?>
					<tr>
						<td colspan=7><div class="empty">No result found.</div></td>
					</tr>
					<?php } ?>
			
			</table>
			
	
	</div>
</div>
