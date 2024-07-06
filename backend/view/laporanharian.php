<?php 
use common\models\Obat;
use common\models\Kartustok;	

$obat = Obat::find()->all();
$stok = Kartustok::find()->select(['kartustok.*', 'SUM(qty) AS qty'])->where(['between', 'DATE_FORMAT(tgl,"%Y-%m-%d")', date('2020-11-20'), date('2020-11-20')])->groupBy('idobat')->orderBy(['qty' => SORT_DESC])->all();
?>
<table>
	<tr>
		<td>IdObat</td>
		<td>Nama Obat</td>
		<td>Tejual</td>
		<td>Stok / Sisa</td>
	</tr>
</table>
<?php
	foreach($stok as $stok): 
	$oobat = Obat::find()->where(['id'=>$stok->idobat])->all();
?>

	<?=  $stok->idobat ?> : 
	<?=  $stok->qty ?>
	<?=  $stok->stokakhir ?>
	<?php foreach($oobat as $oobat): ?>
		<?=  $oobat->stok ?><br>
	<?php endforeach; ?>
<?php endforeach; ?>
<hr>
<?php foreach($obat as $obat): ?>
	<?=  $obat->id ?><br>
<?php endforeach; ?>