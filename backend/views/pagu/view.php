<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\models\TargetPenerimaan;
/* @var $this yii\web\View */
/* @var $model common\models\Pagu */
$target = TargetPenerimaan::find()->where(['kodepagu'=>$model->kodepagu])->all();

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pagus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagu-view">
	<div class="box">
	<div class="box-header">
		<h4>RENCANA PENERIMAAN BPJS FKTL RUMKIT LANUD SULAIMAN TAHUN 2021</h4>
	</div>
	<div class="box-body">


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
				'attribute'=>'Jenis Pagu',
				'value'=>$model->bayar->jenisbayar,
				],
            'kodepagu',
             [
				'attribute'=>'Nilai Pagu',
				'value'=>'Rp. '. Yii::$app->algo->IndoCurr($model->nilaipagu),
				],
            'tahun',
            'iduser',
        ],
    ]) ?>
	<hr>
		<table class='table table-hover table table-bordered'>
			<thead>
				<tr>
					<th>No</th>
					<th>Bulan</th>
					<th>Nilai Pagu</th>
					<th>Detail</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$no=1;
				if($target){
					foreach($target as $t):
			?>
			<tr>
				<td><?= $no++ ?></td>
				<td><?= date('F',strtotime($t->tahun.'-'.$t->bulan.'-01')) ?></td>
				<td>Rp. <?=  Yii::$app->algo->IndoCurr($model->nilaipagu / 12) ?></td>
				<td><a href='<?= Url::to(['pagu/detail-target?id='.$t->id]) ?>'>Lihat detail >>> </a></td>
			</tr>
			<?php endforeach;?>
			
			<?php }else{ ?>
			<tr>
				<td colspan=3>Belum ada data</td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
	</div>
</div>
