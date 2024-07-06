<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use common\models\Usgdetail;
/* @var $this yii\web\View */
/* @var $model common\models\Usg */
$usgdetail = Usgdetail::find()->where(['idusg'=>$model->idusg])->all();
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Usgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$no =1;
?>
<div class="usg-view">
		
			<div class='box box-body'>
				<div class='container-fluid'>
					<div class='row'>
						<h2>Detail Pasien</h2><hr>
						<div class='col-md-8'>
						<table class='table table-bordered'>
							<tr>
								<td width=150>Nama Pasien</td>
								<td width=20>:</td>
								<td><?= $model->nama?></td>
							</tr>
							<tr>
								<td>No RM</td>
								<td>:</td>
								<td><?= $model->no_rekmed ?></td>
							</tr>
							<tr>
								<td>Usia</td>
								<td>:</td>
								<td><?= $model->usia ?> th</td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td>:</td>
								<td><?= $model->alamat ?></td>
							</tr>
							<tr>
								<td>Dokter Pemohon</td>
								<td>:</td>
								<td>
									<?php if($model->stpasien == 'RS'){echo $model->dokter;}else{echo $model->dl;} ?>
								</td>
							</tr>
						</table>
						</div>
					</div>
				</div>
				<div class='container-fluid'>
					<div class='row'>
						<h2>Detail Pemeriksaan</h2><hr>
						<div class='col-md-8'>
						<a href='<?= Url::to(['usgdetail/create/'.$model->id]) ?>' class='btn btn-sm btn-success'>+ Tambah</a><hr>
						<table class='table table-bordered'>
							<tr>
								<th>No</th>
								<th>Klinis</th>
								<th>Nama Pemeriksaan</th>
								<th>Status Pemeriksaan</th>
								<th>Action</th>
							</tr>
							<?php foreach($usgdetail as $ud): ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $ud->klinis ?></td>
								<td><?= $ud->pemeriksaan->namausg ?></td>
								<td>
								<?php if($ud->status == 1){echo"Selesai";}else{echo"Belum Selesai";} ?>
								</td>
								
								<?php if($ud->status == 1){ ?>
									<td><a href='<?= Url::to(['usgdetail/update/'.$ud->id]) ?>'><span class="label label-success">Edit</span></a><a href='<?= Url::to(['usgdetail/fp/'.$ud->id],['target' => '_blank']) ?>'><span class="label label-warning">Print</span></a></td>
									
									<?php }else{ ?>
									<td><a href='<?= Url::to(['usgdetail/perikrad/'.$l->id]) ?>'><span class="label label-success">Test</span></a></td>
									<?php } ?>
							
							</tr>
							<?php endforeach; ?>
						</table>
						</div>
					</div>
				</div>
			</div>
		
</div>
