<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use common\models\Lab;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\LabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$lab = Lab::find()->groupBy(['idrawat'])->orderBy(['tanggal_req'=>SORT_DESC])->all();
$this->title = 'Labs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-index" style='margin-top:20px;'>
	<div class='container-fluid'>
	
		<div class='row'>
			<div class='col-md-12 col-xs-12' >
				<div class='box box-body'>
				<?php  echo $this->render('_searchlab', ['model' => $searchModel]); ?>
				<?= GridView::widget([
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'hover' => true,
				'bordered' =>false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'idrawat',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->idrawat;
						},
					],
					[
						'attribute' => 'RM',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->rawatja->no_rekmed;
						},
					],
					
					[
						'attribute' => 'Nama Pasien ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->rawatja->pasien->nama_pasien;
						},
					],
					[
						'attribute' => 'Usia ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->rawatja->pasien->usia.' th';
						},
					],
					[
						'attribute' => 'Jam Request ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return  date('G:i A',strtotime($model->tanggal_req));
						},
					],
					[
						'attribute' => 'Tanggal Request ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return  date('d F Y',strtotime($model->tanggal_req));
						},
					],
					[
						'attribute' => 'Pengirim ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->dokter->namadokter;
						},
					],
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
						'template' => '{view}',
						'buttons' => [
								
								'view' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
												Url::to(['rawatjalan/periksalab/'.$model->rawatja->id]));
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
