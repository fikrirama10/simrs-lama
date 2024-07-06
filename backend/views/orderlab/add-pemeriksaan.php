<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use kartik\date\DatePicker;
use yii\helpers\Url;
use common\models\Kattindakanlab;
use common\models\Lab;
use yii\helpers\ArrayHelper;
$lab2 = Lab::find()->where(['kodelab'=>$model->kodelab])->all();
?>
<div class='box'>
	<div class='box-header'>
	<h4>List Periksa Lab <?= $model->kodelab ?> </h4><hr>
						<h6>Nama Pasien : <?= $model->pasien->nama_pasien ?> <a href='<?= Url::to(['orderlab/update/'.$model->id]) ?>'><span class="label label-info"><span class="fa fa-pencil"></span></span></a></h6>
						<h6>Pengirim : <?= $model->dokter->namadokter ?></h6><hr>
						<h6>Tanggal  : <?= date('Y / m / d',strtotime($model->tgl_order)) ?></h6>
	</div>
	<div class='box-body'>
		<?php $form = ActiveForm::begin(); ?>
		<?= $form->field($lab, 'idkatjenisp')->dropDownList(ArrayHelper::map(Kattindakanlab::find()->all(), 'id', 'nama'),['prompt'=>'- Tindakan Lab -'])->label('Tindakan Lab')?> 
		<?= Html::submitButton('+', ['class' => 'btn btn-success']) ?>
		<?php ActiveForm::end(); ?>
		<hr>
							<table class="table table-bordered">
						<tr>	
							
							<th>Jenis Pemeriksaan</th>
							<th>Tanggal</th>
							<th>Jam Hasil</th>
							<th>Status</th>
							<th>#</th>
						
						</tr>
					<?php foreach($lab2 as $l): ?>
					
					<tr>
						<td>
						<?php if($l->idkatjenisp == null){echo'Pemeriksaan kosong harap edit / hapus';}else{ ?>
						<?= $l->katlab->nama?><?php } ?></td>
						
						<td><?=  date('G:i A',strtotime($l->tanggal_req))?></td>
						<td><?php if($l->tgl_peniksa == null){echo"-";}else{?>
						<?=  date('G:i A',strtotime($l->tgl_peniksa))?>
						<?php } ?>
						</td>
						
						<td>
							<?php if($l->status == 1){echo'<i class="fa fa-check"></i>';}
							else{echo'<i class="fa fa-close"></i>';}
							?>
						</td>
						<td>	 <?= Html::a(
												'<span class="label label-danger"><span class="fa fa-trash"></span></span>', 
												Url::to(['/orderlab/hapus/'.$l->id]),
												[
												'title' => Yii::t('yii', 'Delete'),
												'data-confirm' => Yii::t('yii', 'Are you sure to delete this '.$model->pasien->nama_pasien.' ?'),
												'data-method' => 'post',
												]);?></td>
					</tr>
					<?php endforeach; ?>
					</table>
	</div>
	<div class='box-footer'>
	 <a class='btn btn-primary btn-md pull-right' href='<?= Url::to(['/orderlab/'.$model->id]) ?>'>Selesai</a>
	</div>
</div>