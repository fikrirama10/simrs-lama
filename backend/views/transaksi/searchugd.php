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
	<table class='table table-bordered'>
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Rawat</th>
			<th>Jumlah</th>
			<?php foreach($jenis as $j): ?>
			<th><?= $j->jenistarif?></th>
			<?php endforeach; ?>
		</tr>
		
 <?php  for($a=0; $a < count($transaksi); $a++){ ?>
	 <?php if($transaksi[$a]['Total'] == $transaksi[$a]['Totall']){echo'<tr>';}else{ ?>
	 <tr style="background-color:#FF0000">
	<?php } ?>
		<td><?= $no++ ?></td>
		<th><?= $transaksi[$a]['TrxId'] ?></th>
		<th><?= $transaksi[$a]['JenisRawat'] ?></th>
		<th>Rp. <?= Yii::$app->algo->IndoCurr($transaksi[$a]['Total'])?></th>	
	<?php foreach($tar as $tr): ?>
	
	<?php $trxtc = Trandetail::find()->joinWith(['tindakan as t'])->where(['t.jenistarif'=>$tr->jenistarif])->andWhere(['idtrx'=> $transaksi[$a]['TrxId']])->sum('total'); ?>	
	
		<td><?= $trxtc ?></td>
		
	 <?php endforeach; ?>

	</tr>
 <?php } ?>

</table>
