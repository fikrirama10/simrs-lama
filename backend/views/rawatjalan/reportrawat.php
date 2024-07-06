<?php
use common\models\Lab;
use common\models\Pemriklab;
use common\models\Idlab;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use common\models\Subkattindakanlab;
use common\models\Kattindakanlab;
use yii\helpers\Url;

?>

<table class='table table-bordered'>
	<tr>
		<td>Pasien awal tahun</td>
		<td>Pasien akhir tahun</td>
		<td>Pasien masuk</td>
		<td>Jumlah hari perawatan</td>
	</tr>
	<tr>
		<td><?= $jpawal?></td>
		<td><?= $jpakhir?></td>
		<td><?= $jp?></td>
		<td><?= $total?></td>
	</tr>
</table>