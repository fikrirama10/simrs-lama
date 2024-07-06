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
			<th>Jumlah</th>
			<?php foreach($jenis as $j): ?>
			<th><?= $j->jenistarif?></th>
			<?php endforeach; ?>
		</tr>
		
 <?php foreach($transaksi as $t): ?>
	 <tr>
		<td><?= $no++ ?></td>
		<th><?= $t->idtrx ?></th>
		<th>Rp. <?= Yii::$app->algo->IndoCurr($t->total)?></th>	
	<?php foreach($tar as $tr): ?>
	
	<?php $trxtc = Trandetail::find()->joinWith(['tindakan as t'])->where(['t.jenistarif'=>$tr->jenistarif])->andWhere(['idtrx'=>$t->idtrx])->sum('total'); ?>	
	
		<td><?= $trxtc ?></td>
		
	 <?php endforeach; ?>

	</tr>
 <?php endforeach; ?>

</table>
