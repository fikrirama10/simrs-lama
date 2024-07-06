<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\grid\GridView;
use common\models\Pasien;
use dosamigos\chartjs\ChartJs;
use common\models\Dokter;
use common\models\Poli;
use hscstudio\chart\ChartNew;
$dewasa = [];
$lansia = [];

$dewasa[]= $lengkap;
$lansia[]= $tidak;
?>	
<div class='com-md-12'>
	<?= ChartNew::widget([
					  'type'=>'bar', # pie, doughnut, line, bar, horizontalBar, radar, polar, stackedBar, polarArea
					  'title'=>'Kelengkap Pengisian rekamedis UGD',
					'labels'=>['Kelengkap Pengisian rekamedis'],
					  'datasets' => [
						  ['title'=>'Lengkap','data'=> $dewasa],
						  ['title'=>'Tidak lengkap','data'=> $lansia],
					  ],
										]);

					?>
</div>				
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
							return "UGD";
						
							
						},
					],
					
					
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{delete}{update}',
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
																
								
								
							],
					],
										
	
					
				],
			]); ?>