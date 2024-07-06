	<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\grid\GridView;
use common\models\Pasien;
use yii\widgets\Pjax;



?>
			<?php Pjax::begin(); ?>
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
						$pasien=Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->all();
							if($pasien == null){
								return'-';
							}else{
								return $model->pasien->nama_pasien;
							}	
						},
					],
					[
						'attribute' => 'Usia',
						'format' => 'raw',
						
						'value' => function ($model, $key, $index) { 
						$pasien=Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->all();
							if($pasien == null){
								return'-';
							}else{
								return $model->pasien->usia;
						}
						},
					],
					[
						'attribute' => 'Usia',
						'format' => 'raw',
						
						'value' => function ($model, $key, $index) { 
						return $model->no_rekmed;}
					],
					
					[
						'attribute' => 'Jenis Pemerikasaan',
						'format' => 'raw',
						
						'value' => function ($model, $key, $index) { 
						return $model->periksa->namapemeriksaan;}
					],
					[
						'attribute' => 'Jam Diambil',
						'format' => 'raw',
						
						'value' => function ($model, $key, $index) { 
						return $model->jamdiambil;}
					],
					[
						'attribute' => 'Jam Hasil',
						'format' => 'raw',
						
						'value' => function ($model, $key, $index) { 
						return $model->jamhasil;}
					],
					[
						'attribute' => 'Durasi',
						'format' => 'raw',
						
						'value' => function ($model, $key, $index) { 
						return $model->durasi;}
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
			<?php Pjax::end(); ?>
		