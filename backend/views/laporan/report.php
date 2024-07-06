<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Jenisrawat;

use common\models\Poli;
$this->title = 'Laporan Rawat Jalan';
$poli = Poli::find()->where(['id'=>$search])->one();

?>
<div  class="trx" style="font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
	<div class='header-kunjungan'>
	<div class='header-kunjungan-judul'>
		<div class="header-kunjungan-judul-au">
		KODIKLATAU <br>PANGKALAN TNI AU SULAIMAN
		</div>
		
	</div>
	

</div>
<div class='judul-kunjungan'>
	<b>LAPORAN BULANAN<br> KUNJUNGAN RAWAT JALAN <?=  $title ?></b>
	</div>
	<p>Umum :<?= $umum ?></p>
	<p>Bpjs :<?= $bpjs ?></p>
			<table>	
				<tr>
						<th>#</th>
						<th>RM</th>
						<th>Nama Pasien</th>
						<th>Alamat</th>
						<th>Gender</th>
						<th>Usia</th>
						<th>Tanggal</th>
						<th>Poli</th>
						<th>Dpjp</th>
						<th>Jenis bayar</th>
						<th>Diagnosa</th>
						<th>RR</th>
						
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
						<td><?= $data->pasien->nama_pasien ?></td>
						<td><?= $data->pasien->alamat ?></td>
						<?php if($data->pasien->jenis_kelamin == null){echo"<td></td>";}else{?>
						<td><?= $data->pasien->jenis_kelamin ?></td>
						<?php } ?>
						<td><?= $data->pasien->usia ?> th</td>
						<td><?= date('d/m/Y', strtotime($data->tgldaftar)) ?></td>
						<td><?= $data->polii->namapoli ?></td>
						<?php if($data->iddokter == null){echo'<td></td>';}else{ ?>
						<td><?= $data->dokter->namadokter?></td>
						<?php } ?>
						<td><?= $data->carabayar->jenisbayar?></td>
						<td width=150><?= $data->pasien->stpasien?></td>
						<td width=150><?php if($data->rencranap != 1){echo"X";}else{echo"O";}?></td>
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
