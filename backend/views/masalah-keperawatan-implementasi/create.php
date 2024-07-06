<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\MasalahKeperawatanImplementasi;


/* @var $this yii\web\View */
/* @var $model common\models\MasalahKeperawatanImplementasi */
$date = date('Y-m-d',strtotime('+5 hour',strtotime(date('Y-m-d'))));
$implementasi = MasalahKeperawatanImplementasi::find()->where(['idrawat'=>$rawat->id])->andWhere(['tanggal'=>$date])->all();
$this->title = 'Create Masalah Keperawatan Implementasi';
$this->params['breadcrumbs'][] = ['label' => 'Masalah Keperawatan Implementasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
<div class=" box-header">
	<h4><?= $rawat->pasien->sbb ?>, <?= $rawat->pasien->nama_pasien?> ( <?= $rawat->pasien->jenis_kelamin?> )</h4>
			<a style='color:grey;'>RM: <?= $rawat->no_rekmed ?> <b>|</b> No Rawat: <?= $rawat->idrawat?></a>
			<h6><?= $rawat->pasien->tempat_lahir?>, <?= date('d F Y',strtotime($rawat->pasien->tanggal_lahir)) ?> ,<?=$rawat->pasien->usia?> th</h6>
			
</div>
<div class=" box-body">

    <?= $this->render('_form', [
        'model' => $model,
        'rawat' => $rawat,
    ]) ?>

</div>
</div>
<div class='box box-body'>
	<table class='table table-bordered'>
		<tr>
			<th width='100'>Tanggal</th>
			<th width='100'>Jam</th>
			<th>Implementasi</th>
			<th>Perawat</th>
		</tr>
		<?php foreach($implementasi as $im){ ?>
		<tr>
			<td><?= $im->tanggal ?></td>
			<td><?= $im->jam ?></td>
			<td><?= $im->asu->implementasi ?> ( <?= $im->implementasi ?> )</td>
		</tr>
		<?php } ?>
	</table>
	<hr>
	<a href='<?= Url::to(['/rawatinap/'.$rawat->id]) ?>' class='btn bg-purple'>Selesai</a>
</div>
