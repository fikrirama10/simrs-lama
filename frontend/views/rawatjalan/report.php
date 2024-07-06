<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Jenisrawat;
$this->title = 'Laporan Penjualan';
$jenisrawat = Jenisrawat::find()->where(['id'=>$search])->one();
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
	<?php if($search == ''){echo "Rawat";}else{ echo $jenisrawat->jenisrawat ;}?>
	<?= $title?></h4>
	</div>
	<div class='headerbr'>

	</div>
</div>
		<div class="box-body table-responsive">
			<table class="tables" style="width:100%;">
				<thead>
					<tr style="background:#f0f0f0">
						<th>#</th>
						<th>RM</th>
						<th>Nama Pasien</th>
						<th>Tanggal</th>
						<th>Jenis Rawat</th>
						<th>Rawat</th>
						<th>Jenis bayar</th>
						
					</tr>
				</thead>
				<tbody style='border:1px solid;'>
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
						<td><?= $data->jerawat->jenisrawat ?></td>
						<?php if($data->idjenisrawat == 3){echo"<td>IGD</td><td>".$data->carabayar->jenisbayar ."</td>";}else{?>
						<?php if($data->idpoli == null){echo"<td>Kamar ".$data->kamar->namaruangan."</td>";}else{?>
						<td><?= $data->polii->namapoli ?></td>
						<td><?= $data->carabayar->jenisbayar ?></td>
					</tr>
					<?php 
						}}}
						
					}else{
					?>
					<tr>
						<td colspan=7><div class="empty">No result found.</div></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			
		</div>
	</div>
</div>
