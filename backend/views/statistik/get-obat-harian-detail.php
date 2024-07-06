<?php 
use yii\helpers\Url;
	$no=1;
 ?>
<table class='table table-bordered'>
<tr>
	<td>No</td>
	<td>Nama Obat</td>
	<td>Jumlah</td>		
	<td>Satuan</td>		
	<td>#</td>
</tr>
<?php  for($a=0; $a < count($json2); $a++){ ?>
<tr>
	<td><?= $no++ ?></td>
	<td><?=  $json2[$a]['Nama']	?></td>
	<td><?=  $json2[$a]['Jumlah'] ?></td>
	<td><?=  $json2[$a]['Satuan'] ?></td>
	<td><a target='_blank' href='<?= Url::to(['apotek/'.$json2[$a]['id']]) ?>'>detail >></a></td>
</tr>
<?php } ?>
</table>