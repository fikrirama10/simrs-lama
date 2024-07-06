<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\grid\GridView;
use common\models\Diagnosaranap;
use common\models\Pasien;

?>
<?= GridView::widget([
				'dataProvider' => $dataProvider,
				// 'filterModel' => $searchModel,
				'id' => 'ajax_gridview',
				'hover' => true,
				'bordered' =>true,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					// [
						// 'attribute' => 'Tanggal',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
							// return $model->tanggal;
						// },
					// ],
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
						'attribute' => 'RM',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							$pasien=Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->all();
							if($pasien == null){
								return'-';
							}else{
								return $model->no_rekmed;
							}
							
						},
					],
					// [
						// 'attribute' => 'Anamesis',
						// 'format' => 'raw',
						// 'hAlign'=>'center',
						// 'value' => function ($model, $key, $index) { 
							// if($model->anamesisi == 1){								
								// return '<i class="fa fa-check"></i>';
							// }else{
								// return '<i class="fa fa-close"></i>';
							// }
						// },
					// ],
					
					
					[
						'attribute' => 'Diagnosa',
						'format' => 'raw',
						'hAlign'=>'left',
						'value' => function ($model, $key, $index) {
							$diagr = Diagnosaranap::find()->where(['idrawat'=>$model->idrawat])->andwhere(['jenis'=>1])->one();
							$diagrc = Diagnosaranap::find()->where(['idrawat'=>$model->idrawat])->andwhere(['jenis'=>1])->count();
							if($model->kdiagnosa != null){
								return $model->kdiagnosa;
							}else{
								if($diagrc == 1){
									return $diagr->kadiagnosa;
								}else{
									return "";
								}
							}
							
							
						},
					],
					
					[
						'attribute' => 'Kepatuhan Pemakaian Gelang',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
									$diagr = Diagnosaranap::find()->where(['idrawat'=>$model->idrawat])->andwhere(['jenis'=>1])->one();
							$diagrc = Diagnosaranap::find()->where(['idrawat'=>$model->idrawat])->andwhere(['jenis'=>1])->count();
							if($model->kdiagnosa != null){
								return '<span class="label label-success">patuh</span>';
							}else{
								if($diagrc == 1){
									return '<span class="label label-success">patuh</span>';
								}else{
									return '<span class="label label-danger">T patuh</span>';
								}
							}
								

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