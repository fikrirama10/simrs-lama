<?php

use yii\helpers\Html;
use kartik\grid\GridView;

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
				<?= Html::a('<i class="fa fa-plus"></i> Tambah pasien ',['/usg/create'],['class' => 'btn btn-primary']);?>
				<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'hover' => true,
				'bordered' =>false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'tanggal',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->tglusg;
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
							return $model->nama;
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
				
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view}{update}{delete}',
						'buttons' => [
								
								'view' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
												Url::to(['usg/view/'.$model->id]));
								},
								'update' => function ($url,$model) {
										return Html::a(
												'<span class="label label-warning"><span class="fa fa-pencil"></span></span>', 
												Url::to(['usg/update/'.$model->id]));
								},
								'delete' => function ($url,$model) {
										return Html::a(
												'<span class="label label-danger"><span class="fa fa-trash"></span></span>', 
												Url::to(['/usg/delete/'.$model->id]),
												[
												'title' => Yii::t('yii', 'Delete'),
												'data-confirm' => Yii::t('yii', 'Are you sure to delete this  ?'),
												'data-method' => 'post',
												]);
								},
								
								
								
							],
					],
					
	
					
				],
			]); ?>
			
				</div>
				
			</div>
		</div>
	</div>
   
	
	

</div>
