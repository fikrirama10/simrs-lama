<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Jenisrawat;
use common\models\Jenisbayar;
use common\models\Diagnosaranap;
use common\models\Rawat;
use common\models\Dokter;
$this->title = 'Laporan Penjualan';
$jenisrawat = Jenisrawat::find()->where(['id'=>$search])->one();

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
	<b>Daftar Rekamedis Pasien Pulang</b>
	
	</div>
<br>

			<table>
				
					<tr style="background:#f0f0f0">
						<th>#</th>
						<th>No Register</th>
						<th>RM</th>
						<th>Nama Pasien</th>
						<th>Diagnosa</th>
						<th>Usia</th>
						<th>Tanggal Masuk</th>
						<th>Tanggal Keluar</th>
						<th>Keterangan Pulang </th>
						<th>Dokter </th>
						<th width=100>Jenis Rawat</th>
						<th width=100>Jenisbayar</th>
						
					</tr>
				
				
					<?php 
					if(count($dataProvider) > 0){
						$no = 1;
						foreach($dataProvider as $data){
						$dranap = Diagnosaranap::find()->where(['idrawat'=>$data->idrawat])->andwhere(['jenis'=>1])->all();						
					?>
					<input type="hidden" id="trxid" value="<?= $data->id ?>">
					<?php if($data->kdiagnosa != null){echo"";}else{ ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $data->idrawat ?></td>
						<td><?= $data->no_rekmed ?></td>
						<td><?= $data->pasien->nama_pasien ?></td>
						
						<td>
					<?php if($data->idjenisrawat == 2){ ?>
						<?php foreach($dranap as $dr): ?>
							<?= $dr->kadiagnosa ?>
						<?php endforeach; ?></td>
					<?php }else{"<td></td>";} ?>
						<td><?= $data->pasien->usia ?> th</td>
						<td><?= date('d/m/Y', strtotime($data->tgldaftar)) ?></td>
						
						<?php if($data->tglkeluar == null){ ?>
						<td><?= date('d/m/Y',strtotime('+2 day',strtotime(date($data->tgldaftar))))?></td>
						<?php }else{ ?>
						<td><?= date('d/m/Y',strtotime($data->tglkeluar)); ?></td>
						<?php } ?>
						<td><?= $data->carakeluar ?></td>
						<td>
						    <?php
						        $dokter = Dokter::findOne($data->iddokter);
						        if($dokter){
						            $dokter->namadokter;
						        }
						    ?>
						</td>
						<td><?= $data->jerawat->jenisrawat ?></td>
						<td><?= $data->carabayar->jenisbayar ?></td>
			
						
					</tr>
					<?php } ?>
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
