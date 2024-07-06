<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\grid\GridView;
use common\models\Pasien;
?>		

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
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
							return date('d/m/Y',strtotime($model->tanggal));
						
							
						},
					],
					[
						'attribute' => 'No RM',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
							return $model->no_rekmed;
						
							
						},
					],
	[
						'attribute' => 'Nama',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
							$pasien = Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
							if($pasien < 1){
							    return 'Pasien dihapus';
							}else{
							    return $model->pasien->nama_pasien;
							}
						
						
							
						},
					],
					[
						'attribute' => 'Bayar',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
							return $model->nama;
						
							
						},
					],
					[
						'attribute' => 'Jenis Folmulir',
						'format' => 'raw',
						'width' => '180px',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
							return $model->pecah($model->jform);
						
							
						},
					],
					[
						'attribute' => 'DPJP',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
							return $model->dokter->namadokter;
						
							
						},
					],
					[
						'attribute' => 'Tidak Lengkap',
						'format' => 'raw',
						'width' => '180px',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
							return $model->pecah($model->tdklengkap);
						
							
						},
					],
					[
						'attribute' => 'Ruangan',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
							return $model->kamar->namaruangan;
						
							
						},
					],
					
					
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