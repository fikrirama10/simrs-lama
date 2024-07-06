<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use common\models\Ppi;
use common\models\Pasien;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PpiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'AUDIT IDO BUNDLE CHECKLIST';
$this->params['breadcrumbs'][] = $this->title;
$ppi = Ppi::find()->all();

?>
<div class="ppi-index">
				
    		<div class='box box-body table-responsive'>
				 
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    	
				<?= GridView::widget([
				'dataProvider' => $dataProvider,
				// 'filterModel' => $searchModel,
				'id' => 'ajax_gridview',
				'hover' => true,
				'bordered' =>false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'Tanggal',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->tanggal;
						},
					],
					[
						'attribute' => 'Nama Pasien',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							$pasien = Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->one();
							if($pasien == false){
								return $model->no_rekmed;
							}else{
								return $model->pasien->nama_pasien;
							}
						},
					],
					[
						'attribute' => 'CukurDengan e.clipper',
						'width'=>'10px',
						'value' => function ($model, $key, $index) { 
							return $model->cukurclipper;
						},
					],
					[
						'attribute' => 'Waktu Cukur (± 2jam)',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->waktucukur;
						},
					],
					[
						'attribute' => 'Mandi cholrexidine',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->mandi;
						},
					],
					[
						'attribute' => 'Antibiotic 1 jam sebelum insisi',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->antibiotic;
						},
					],
					[
						'attribute' => 'Pasien tidak sedang infeksi',
						'format' => 'raw',
						'width' => '20px',
						'value' => function ($model, $key, $index) { 
							return $model->tdkinfeksi;
						},
					],
					[
						'attribute' => 'Gula Darah Terkontrol',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->kontrolgula;
						},
					],
					
					// [
						// 'attribute' => 'IPCLN',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
							// return $model->ipcln;
						// },
					// ],
					// [
						// 'attribute' => 'Unit',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
							// return $model->unit;
						// },
					// ],
					// [
						// 'attribute' => 'Person',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
							// return $model->person;
						// },
					// ],
					// [
						// 'attribute' => 'Momen 1 ',
						// 'format' => 'raw',
						// 'hAlign'=>'center',
						// 'value' => function ($model, $key, $index) { 
							// if($model->momen1 == 1){								
								// return '<i class="fa fa-check"></i>';
							// }else{
								// return '<i class="fa fa-close"></i>';
							// }
						// },
					// ],
					// [
						// 'attribute' => 'Momen 2 ',
						// 'format' => 'raw',
						// 'hAlign'=>'center',
						// 'value' => function ($model, $key, $index) { 
							// if($model->momen2 == 1){								
								// return '<i class="fa fa-check"></i>';
							// }else{
								// return '<i class="fa fa-close"></i>';
							// }
						// },
					// ],
					// [
						// 'attribute' => 'Momen 3 ',
						// 'format' => 'raw',
						// 'hAlign'=>'center',
						// 'value' => function ($model, $key, $index) { 
							// if($model->momen3 == 1){								
								// return '<i class="fa fa-check"></i>';
							// }else{
								// return '<i class="fa fa-close"></i>';
							// }
						// },
					// ],
					// [
						// 'attribute' => 'Momen 4 ',
						// 'format' => 'raw',
						// 'hAlign'=>'center',
						// 'value' => function ($model, $key, $index) { 
							// if($model->momen4 == 1){								
								// return '<i class="fa fa-check"></i>';
							// }else{
								// return '<i class="fa fa-close"></i>';
							// }
						// },
					// ],
					// [
						// 'attribute' => 'Momen 5 ',
						// 'format' => 'raw',
						// 'hAlign'=>'center',
						// 'value' => function ($model, $key, $index) { 
							// if($model->momen4 == 1){								
								// return '<i class="fa fa-check"></i>';
							// }else{
								// return '<i class="fa fa-close"></i>';
							// }
						// },
					// ],
					// [
						// 'attribute' => 'Kepatuhan ',
						// 'format' => 'raw',
						// 'hAlign'=>'center',
						// 'value' => function ($model, $key, $index) { 
							// $cuci = $model->momen1 + $model->momen2 + $model->momen3 + $model->momen4 + $model->momen5 ;
							// $hitung = $cuci/5*10;
							// return $hitung.'';
							// },
					// ],
					
					
					// [
						// 'attribute' => 'Ket',
						// 'format' => 'raw',
						// 'hAlign'=>'center',
						// 'value' => function ($model, $key, $index) { 
							// $cuci = $model->momen1 + $model->momen2 + $model->momen3 + $model->momen4 + $model->momen5 ;
							// $hitung = $cuci/5*10;
							// if($hitung < 10){								
								// return '<span class="label label-danger">Tidak Patuh</span>';
							// }else{
								// return '<span class="label label-success">Patuh</span>';
							// }
						// },
					// ],
					
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{update}',
						'buttons' => [
						
															
								'update' => function ($url,$model) {
										return Html::a(
												'<span class="label label-warning"><span class="fa fa-pencil"></span></span>', 
												$url);
								},
																
								
								
							],
					],
					
	
					
				],
			]); ?>
		</div>
</div>
