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
$lab = Lab::find()->where(['kodelab'=>$model->kodelab])->all();
?>
<div class='container-fluid'>
	<div class='row'>
		<div class='col-md-12'>
		
			<div class='box box-body'>
				<div class='row'>
					<div class='col-md-12'>
					
					</div>
					<div class='col-md-12'>
					<a class='btn btn-warning btn-md pull-right' href='<?= Url::to(['/orderlab/printlab/'.$model->id]) ?>'>Print</a><hr>
						<h4>List Periksa Lab <?= $model->kodelab ?> </h4><hr>
						<h6>Nama Pasien : <?= $model->pasien->nama_pasien ?> <a href='<?= Url::to(['orderlab/update/'.$model->id]) ?>'><span class="label label-info"><span class="fa fa-pencil"></span></span></a></h6>
						<h6>Pengirim : <?= $model->dokter->namadokter ?></h6><hr>
						<h6>Tanggal  : <?= date('Y / m / d',strtotime($model->tgl_order)) ?></h6><hr>
					 <a class='btn btn-success btn-md ' href='<?= Url::to(['/orderlab/tambah-pemeriksaan?id='.$model->id]) ?>'>Tambah Pemeriksaan</a><hr>
					<table class="table table-bordered">
						<tr>	
							
							<th>Jenis Pemeriksaan</th>
							<th>Tanggal</th>
							<th>Jam Hasil</th>
							<th>Status</th>
							<th>#</th>
						
						</tr>
					<?php foreach($lab as $l): ?>
					
					<tr>
						<td>
						<?php if($l->idkatjenisp == null){echo'Pemeriksaan kosong harap edit / hapus';}else{ ?>
						<?= $l->katlab->nama?><?php } ?></td>
						
						<td><?=  date('d-m-Y',strtotime($l->tanggal_req))?></td>
						<td><?php if($l->tgl_peniksa == null){echo"-";}else{?>
						<?=  date('H:i:s',strtotime('+2 hour',strtotime($l->tgl_peniksa)))?>
						<?php } ?>
						</td>
						
						<td>
							<?php if($l->status == 1){echo'<i class="fa fa-check"></i>';}
							else{echo'<i class="fa fa-close"></i>';}
							?>
						</td>
						<td><a href='<?= Url::to(['lab/pemriklabub/'.$l->id]) ?>'><span class="label label-success">Test</span></a> | <?= Html::a(
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
				</div>
			</div>

		</div>
	</div>
</div>
