<?php

use yii\helpers\Html;
use common\models\Tindakandokter;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Rawat */

$this->title = 'Tindakan dokter';
$this->params['breadcrumbs'][] = ['label' => 'Rawats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$tindakan = Tindakandokter::find()->where(['kode_rawat'=>$model->idrawat])->andwhere(['DATE_FORMAT(tgl,"%Y-%m-%d")' => date('Y-m-d')])->all();
?>
<div class='container-fluid' style='background:#fff; margin-top:10px;'>
<div class="rawat-create">

    <h1><?= Html::encode($this->title) ?></h1><hr>

    <?= $this->render('_formtindakan', [
        'tindakandokter' => $tindakandokter,
        'model' => $model,
    ]) ?>
	
</div>
<div class='col-md-12' style='margin-top:20px;'>
	<div class='box box-body'>
	<table class="table table-hover">
		<tr>
			<th>Nama Tindakan</th>
			<th>Dokter Penanggung Jawab</th>
			<th>Di tindak Oleh</th>
			
			<th>#</th>
		</tr>
	<?php foreach($tindakan as $t):?>
		<tr>
			<td><?= $t->tindakan->namatindakan ?></td>
			<td><?= $t->dokter->namadokter ?></td>
			<td></td>
			<td><a href='<?= Url::to(['rawatinap/delete/'.$t->id]) ?>'><span class="label label-danger"><i class="fa fa-close"></i></span></td></a>
		</tr>
	<?php endforeach; ?>
	</table>
	
	</div>
	<a href='<?= Url::to(['rawatinap/'.$model->id]) ?>' class='btn btn-primary btn-xs pull-right' style='margin-bottom:10px;'>Selesai</a>
	</div>
	
</div>
