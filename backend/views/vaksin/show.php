<?php
use common\models\Poli;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\web\View;
$no = 1;
?>
<hr>
<a id="show-all"target='_blank' href='<?= Url::to(['vaksin/print?tgl='.$tgl.'&vaksin='.$vaksin])?>' class="btn btn-warning" ><span class="fa fa-print" style="width: 20px;" ></span>Print</a>
<hr>
<table class='table table-bordered'>
	<tr>
		<th>No</th>
		<th>No Register</th>
		<th>Nama</th>
		<th>Tgl Lahir</th>
		<th>Usia</th>
		<th>Alamat</th>
		<th>Jadwal Vaksin</th>
		<th>Vaksin Ke</th>
	</tr>
	<?php foreach($kuota as $k){ ?>
	<tr>
		<td><?= $no++ ?></td>
		<td><?= $k['noregistrasi'] ?></td>
		<td><?= $k['nama'] ?></td>
		<td><?= $k['tgllahir'] ?></td>
		<td><?= $k['usia'] ?></td>
		<td><?= $k['alamat'] ?></td>
		<td><?= $k['tglvaksin'] ?></td>
		<td><?= $k['vaksin'] ?></td>
	</tr>
	<?php } ?>
</table>