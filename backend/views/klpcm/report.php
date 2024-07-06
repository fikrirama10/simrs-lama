<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Jenisrawat;

use common\models\Poli;
$this->title = 'Laporan Rawat Jalan';
$poli = Poli::find()->where(['id'=>$search])->one();

?>
<div  class="klpcm" style="font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
	<div class='header-kunjungan'>
	<div class='header-kunjungan-judul'>
		<div class="header-kunjungan-judul-au">
		KODIKLATAU <BR>PANGKALAN TNI AU SULAIMAN
		</div>
		
	</div>
	

</div>
<div class='judul-klpcm'><br>
	<b>LAPORAN KETIDAKLENGKAPAN PENCATATAN CATATAN MEDIS<br>Tahun <?= date('Y',strtotime($title))?></b>
	</div>
	<div  style='font-size:20px;'><b>Bulan : <?= date('F',strtotime($title))?></b></div>
			<table>	
				<tr>
						<th>#</th>
						<th>RM</th>
						<th>Nama</th>
						<th>Formulir</th>
						<th>Dpjp</th>
						<th>Tidak Lengkap</th>
						<th>Ruangan</th>
						<th>Dilengkapi</th>
						
					</tr>
			
					<?php 
					if(count($dataProvider) > 0){
						$no = 1;
						foreach($dataProvider as $data){
													
					?>
					<input type="hidden" id="trxid" value="<?= $data->id ?>">
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $data->no_rekmed ?></td>
						<td><?= $data->pasien->no_rekmed ?></td>
						<td><?= $data->pecah($data->jform) ?></td>
						<td><?= $data->dokter->namadokter ?></td>
						<td><?= $data->pecah($data->tdklengkap) ?></td>
						<td><?= $data->kamar->namaruangan ?></td>
						<td></td>
						
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
