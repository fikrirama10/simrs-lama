<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\grid\GridView;
use common\models\Dokter;
use common\models\Pasien;
use common\models\Poli;
?>		<?= GridView::widget([
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
						'attribute' => 'Dokumen',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
							return $model->dokumen;
						
							
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
							if($pasien < 1 ){
							return "data gk ada";
							}else{
								return $model->pasien->nama_pasien;
							}
						
							
						},
					],
					[
						'attribute' => 'Jenis Folmulir',
						'format' => 'raw',
						'width' => '180px',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
								if($model->jform == '""'){
								return '""';
							}else{
							return $model->pecah($model->jform);
							}
						
							
						},
					],
					[
						'attribute' => 'DPJP',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
							
						$pasien = Dokter::find()->where(['id'=>$model->dpjp])->count();
							if($pasien < 1 ){
							return "data gk ada";
							}else{
								return $model->dokter->namadokter;
							}
							
						},
					],
					[
						'attribute' => 'Tidak Lengkap',
						'format' => 'raw',
						'width' => '180px',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
							if($model->tdklengkap == '""'){
								return '""';
							}else{
							return $model->pecah($model->tdklengkap);
							}
							
						},
					],
					[
						'attribute' => 'poliklinik',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
							$pasien = Poli::find()->where(['id'=>$model->idpoli])->count();
							if($pasien < 1 ){
							return "data gk ada";
							}else{
								return $model->poli->namapoli;
							}
						
							
						},
					],
					
					
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{delete}{update}{view}',
						'buttons' => [
						
															
								'delete' => function ($url,$model) {
										return Html::a(
												'<span class="label label-danger"><span class="fa fa-trash"></span></span>', 
												$url,
												[
												'title' => Yii::t('yii', 'Delete'),
												'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
												'data-method' => 'post',
												]);
								},
									'update' => function ($url,$model) {
										return Html::a(
												'<span class="label label-warning"><span class="fa fa-pencil"></span></span>', 
												$url);
								},
								'view' => function ($url,$model) {
										return Html::a(
												'<span class="label label-success"><span class="fa fa-eye"></span></span>', 
												$url);
								},
																
								
								
							],
					],
					
	
					
				],
			]); ?>