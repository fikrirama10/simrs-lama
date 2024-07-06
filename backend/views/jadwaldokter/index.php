<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel common\models\JadwaldokterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$no = 1;
$this->title = 'Jadwaldokters';
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="jadwaldokter-index box box-body">
	<h3>Jadwal Dokter</h3>
	<table class='table table-bordered'>
		<tr>
			<th>No</th>
			<th>Nama Dokter</th>
			<th>Spesialis</th>
			<th>#</th>
		</tr>
	<?php foreach($model as $m){ ?>
		<tr>
			<td><?= $no++?></td>
			<td><?= $m->dokter->namadokter?></td>
			<td><?= $m->dokter->poli->namapoli?></td>
			<td><a href='<?= Url::to(['dokter/'.$m->iddokter]) ?>' title='Update' id='confirm' ><span class="label label-success"><span class="fa fa-pencil"></span></span></a></td>
		</tr>
		
	<?php } ?>		
	</table>

</div>
