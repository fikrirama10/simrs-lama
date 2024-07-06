<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Lab;
use common\models\Pasien ;
use common\models\Radiologidetail;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\LabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Labs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-index" style='margin-top:20px;'>
	<div class='container-fluid'>
	
		<div class='row'>
			<div class='col-md-12 col-xs-12' >
				<div class='box box-body'>
				<h2>Daftar Order Radiologi</h2><hr>
				<?php   echo $this->render('_search', ['model' => $searchModel]); ?>
				<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'columns' => [
				 ['class' => 'yii\grid\ActionColumn'],

					[
						'attribute' => 'tanggal',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return date('Y \ m \ d',strtotime($model->tanggal));
						},
					],
				
					[
						'attribute' => 'No RM',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->no_rekmed;
						},
					],
					[
						'attribute' => 'Nama',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							$pasien = Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->one();
							$pasienc = Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
							if($pasien == null){
								return "Silahkan edit no rm salah";
							}else{
								return $pasien->nama_pasien;
							}
						},
					],
						[
						'attribute' => 'Pemeriksaan',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							$rad = Radiologidetail::find()->where(['idrad'=>$model->idrad])->all();
							if(count($rad) > 0){
							foreach($rad as $r):
								 return $r->drad->jenispemeriksaan;
								endforeach;
							}else{
							    return '-';
							}	
						},
					],
					[
						'attribute' => 'Pekeriksa',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							
							return $model->user->pegawai->nama_petugas;
			
							
						},
					],
					[
						'attribute' => 'Jenis Bayar',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							
							return $model->rawatjalan->carabayar->jenisbayar;
			
							
						},
					],
					[
						'attribute' => 'Status',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							$detail = Radiologidetail::find()->where(['idrad'=>$model->idrad])->one();
							$detailc = Radiologidetail::find()->where(['idrad'=>$model->idrad])->count();
							if($detailc == 0){
								return"hapus weh";
							}else{
							if($detail->status == 0){
								return '<span class="label label-danger">Belum Di Test</span>';
							}else{
								return '<span class="label label-success">Sudah Di Test</span>';
							}}
						},
					],
					// [
						// 'attribute' => 'Nama Pasien',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
							// return $model->pasien->nama_pasien;
						// },
					// ],
					// [
						// 'attribute' => 'RM',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
							// return $model->rawatja->no_rekmed;
						// },
					// ],
					
					// [
						// 'attribute' => 'Nama Pasien ',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
							// return $model->rawatja->pasien->nama_pasien;
						// },
					// ],
					// [
						// 'attribute' => 'Usia ',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
							// return $model->rawatja->pasien->usia.' th';
						// },
					// ],
					// [
						// 'attribute' => 'Jam Request ',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
							// return  date('G:i A',strtotime($model->tanggal_req));
						// },
					// ],
					// [
						// 'attribute' => 'Tanggal Request ',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
							// return  date('d F Y',strtotime($model->tanggal_req));
						// },
					// ],
					// [
						// 'attribute' => 'Pengirim ',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
							// return $model->dokter->namadokter;
						// },
					// ],
					// [
						// 'attribute' => 'Dari ',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
							// return $model->tkp->jenisrawat;
						// },
					// ],
					// [
						// 'attribute' => 'Alamat ',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
							// return $model->pegawai->alamat;
						// },
					// ],
					// [
						// 'attribute' => 'Username ',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
							// return $model->username;
						// },
					// ],
				
				 ['class' => 'yii\grid\ActionColumn'],
					
	
					
				],
			]); ?>
			
				</div>
				
			</div>
		</div>
	</div>
   
	
	

</div>
