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
$labid = Idlab::find()->where(['idrawat'=>$model->idrawat])->all(); 
$lab = Lab::find()->where(['idrawat'=>$model->idrawat])->all();
$labg = Lab::find()->where(['idrawat'=>$model->idrawat])->groupby(['idjenisp'])->all();
$sumh = Lab::find()->where(['idrawat'=>$model->idrawat])->andwhere(['idjenisp'=>2])->sum('status');
$labp = Lab::find()->where(['idrawat'=>$model->idrawat])->groupby(['idpengirim'])->all();
$hherma = Pemriklab::find()->where(['idrawat'=> $model->idrawat])->groupby(['idtindakan'])->all();
?>

<div class='container-fluid'>
	<div class='row'>
		<div class='col-md-12'>
			<?php foreach($labid as $li): ?>
				<?= $li->id?>
			<?php endforeach; ?>
			<div class='box box-body'>
				<div class='row'>
					<div class='col-md-12'>
						<h4><?= $model->pasien->nama_pasien?></h4>
						<h6><?= $model->no_rekmed?></h6>
						<?php foreach($labp as $labb):?>
						Pengirim :	<b><?= $labb->dokter->namadokter?></b><hr>
						<?php endforeach;?>
					</div>
					<div class='col-md-12'>
						<h4>List Periksa Lab</h4>
					<table class="table table-bordered">
						<tr>
							<th>Id Rawat</th>
							<th>Jenis Pemeriksaan</th>
							<th>Tanggal</th>
							<th>Jam Request</th>
							<th>Jam Hasil</th>
							<th>Pemeriksa</th>
							<th>Status</th>
							<th>#</th>
						
						</tr>
					<?php foreach($lab as $l): ?>
					<tr>
						<td><?= $l->idrawat ?></td>
						<td><?= $l->katlab->nama ?></td>
						<td><?= date('d F Y',strtotime($l->tanggal_req)) ?></td>
						<td><?=  date('G:i A',strtotime($l->tanggal_req))?></td>
						<td><?php if($l->tgl_peniksa == null){echo"-";}else{?>
						<?=  date('G:i A',strtotime($l->tgl_peniksa))?>
						<?php } ?>
						</td>
						
						<td><?= $l->idpemeriksa ?></td>
						<td>
							<?php if($l->status == 1){echo'<i class="fa fa-check"></i>';}
							else{echo'<i class="fa fa-close"></i>';}
							?>
						</td>
						<td>
						<?php if($l->status == 1){ ?>
						<a class='btn btn-warning' href='<?= Url::to(['lab/printlab/'.$l->id]) ?>'>Print</a>
						<?php }else{ ?>
						<a href='<?= Url::to(['lab/pemriklab/'.$l->id]) ?>'><span class="label label-success"><?= $l->dlab->namapemeriksaan ?></span></a>
						<?php } ?>
						
						</td>
					</tr>
					<?php endforeach; ?>
				</table>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
