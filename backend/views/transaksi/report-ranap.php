	<?php
use common\models\Trandetail;
use common\models\Jenistarif;
use kartik\date\DatePicker;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;
	$no = 1;
	$total = 0;
	$jenis = Jenistarif::find()->all();
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
	<b>LAPORAN RINCIAN PENERIMAAN RAWAT INAP<br>  <?= $title ?></b>
	</div>
	
				<table class='table table-bordered'>
		<tr>
			<th>No</th>
			<th>Tgl</th>
			<th>Nama</th>
			<th  width=40>No RM</th>
			<th  width=40>Kode Dokter</th>
			<th width=100>Jumlah</th>
			<?php foreach($jenis as $j): ?>
			<th><?= $j->jenistarif?></th>
			<?php endforeach; ?>
		</tr>
		
 <?php  for($a=0; $a < count($transaksi); $a++){ ?>
	 <tr>
		<td><?= $no++ ?></td>
		<th><?= $transaksi[$a]['Tgl'] ?></th>
		<th><?= $transaksi[$a]['Nama'] ?></th>
		<th><?= $transaksi[$a]['NoRM'] ?></th>
		<th><?= $transaksi[$a]['Dokter'] ?></th>
		<th>Rp. <?= Yii::$app->algo->IndoCurr($transaksi[$a]['Total'])?></th>	
	<?php foreach($tar as $tr): ?>
	
	<?php $trxtc = Trandetail::find()->joinWith(['tindakan as t'])->where(['t.jenistarif'=>$tr->jenistarif])->andWhere(['idtrx'=> $transaksi[$a]['TrxId']])->sum('total'); ?>	
	
		<td width=30><?= Yii::$app->algo->IndoCurr($trxtc)?></td>
		
	 <?php endforeach; ?>

	</tr>
 <?php } ?>

</table>

			
		
			
	</div>
</div>

 
 
	