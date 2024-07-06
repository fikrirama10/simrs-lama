<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Asesmenpasien */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Asesmenpasiens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asesmenpasien-view">
<div class='container-fluid'  style='background:#fff;'>

    <h1>View</h1>

    
<table class="table table-hover table-bordered">
		<thead style='background:purple; color:#fff;'>
			<th>Tanggal</th>
			<th>Nama Pasien</th>
			<th>Tanggal Lahir</th>
			<th>No RM</th>
			<th>Anamesis</th>
			<th>Asesmen Psikokognitif</th>
			<th>Pemeriksaan Fisik</th>
			<th>Pemeriksaan Penunjang</th>
			<th>Diagnosis</th>
			<th>Rencana Asuhan</th>
			<th>Evaluasi Post Tindakan</th>
			<th>TTD DPJP UGD</th>
			
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?= $model->tanggal?></td>
			<td><?= $model->pasien->nama_pasien ?></td>
			<td><?= $model->pasien->tanggal_lahir ?></td>
			<td><?= $model->no_rekmed ?></td>
			<td align="center">
				<?php if($model->anamesisi == 1){echo"<i class='fa fa-check'></i>";}else{echo"-";} ?>
			</td>
			<td align="center">
				<?php if($model->ass_psiko == 1){echo"<i class='fa fa-check'></i>";}else{echo"-";} ?>
			</td>
			<td align="center">
				<?php if($model->rx_fisik == 1){echo"<i class='fa fa-check'></i>";}else{echo"-";} ?>
			</td>
			<td align="center">
				<?php if($model->penunjang == 1){echo"<i class='fa fa-check'></i>";}else{echo"-";} ?>
			</td>
			<td align="center">
				<?php if($model->diagnosis == 1){echo"<i class='fa fa-check'></i>";}else{echo"-";} ?>
			</td>
			<td align="center">
				<?php if($model->rencanaasuhan == 1){echo"<i class='fa fa-check'></i>";}else{echo"-";} ?>
			</td>
			<td align="center">
				<?php if($model->evaluasi == 1){echo"<i class='fa fa-check'></i>";}else{echo"-";} ?>
			</td>
			<td align="center">
				<?php if($model->ttd == 1){echo"<i class='fa fa-check'></i>";}else{echo"-";} ?>
			</td>
			
		</tr>
	</tbody>
	</table>
	<a href='<?= Url::to(['asesmenpasien/']) ?>' class='btn btn-primary btn-xs pull-right' style='margin-bottom:10px;'>< Back</a>
</div>