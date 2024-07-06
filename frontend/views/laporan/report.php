<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Jenisrawat;

use common\models\Poli;
$this->title = 'Laporan Rawat Jalan';
$poli = Poli::find()->where(['id'=>$search])->one();

?>
<div class="transaksi-index" style="font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
	<div class="box" style="">
		<div class='header1'>
	<div class='logo'>
	<?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/au.png',['class' => 'img img-responsive']);?>
	</div>
	<div class='header2'>
	<h3>RSAU LANUD SULAIMAN</h3>
	<h4>Laporan  
	<?php if($search == ''){echo "Rawat Jalan";}else{ echo "Rawat Jalan ".$poli->namapoli ;}?>
	</h4><a><?= $title?></a>
	</div>
	<div class='headerbr'>

	</div>
</div><hr>
<h5 align=right> Jumlah : <?php echo  count($dataProvider) ?> Pasien :: Pasien BPJS = <?= $bpjs?></h5>
		<div class="lapo">
			<table>	
				<tr>
						<th>#</th>
						<th>RM</th>
						<th>Nama Pasien</th>
						<th>Tanggal</th>
						<th>Poli</th>
						<th>Nama Dokter</th>
						<th>Jenis bayar</th>
						
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
						<td><?= date('d F Y H:i A', strtotime($data->tgldaftar)) ?></td>
						<td><?= $data->polii->namapoli?></td>
						<td><?= $data->dokter->namadokter?></td>
						<td><?= $data->carabayar->jenisbayar?></td>
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
</div>
