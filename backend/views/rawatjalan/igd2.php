<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use common\models\Statusrawat;
$this->title = 'Pasien Rawat';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-body'>
		<h2>Pasien IGD</h2><hr>
			<?= GridView::widget([
				'panel' => ['type' => 'default', 'heading' => 'Daftar Pasien UGD'],
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'hover' => true,
				'bordered' =>false,
				'pjax'=>true,
				'panel' => [
				'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon glyphicon-list-alt"></i> Pasien UGD</h3>',
				'type'=>'warning',
				'after'=>Html::a('<i class="fas fa-redo"></i> Reset Grid', ['index'], ['class' => 'btn bg-navy']),
				
			],
				
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],
					
					'no_rekmed',
					[
						'attribute' => 'Nama Pasien ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->pasien->nama_pasien;
						},
					],
						[
						'attribute' => 'Tanggal Daftar',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return date('d F Y , G:i A',strtotime($model->tgldaftar));
						},
					],
					
					'kdiagnosa',
					[
					'attribute' => 'status', 
					'vAlign' => 'middle',
					'width' => '180px',
					'value' => function ($model, $key, $index, $widget) { 
							if($model->status == 1){
								if($model->batal == 1){
									return '<span class="label label-default">Batal Berobat</span>';
								}else{
									return '<span class="label label-danger">Antrian</span>';
								}
								
							}else if($model->status == 2){
								return '<span class="label label-warning">Pemeriksaan</span>';
							}else if($model->status == 7){
								return '<span class="label label-warning">Selesai</span>';
							}else if($model->status == 8){
								return '<span class="label label-primary label-lg">Rawat inap</span>';
							}else if($model->status == 11){
								return '<span class="label label-default">Batal Berobat</span>';
							}
					},
					'filterType' => GridView::FILTER_SELECT2,
					'filter' => ArrayHelper::map(Statusrawat::find()->all(), 'id', 'status'), 
					'filterWidgetOptions' => [
						'pluginOptions' => ['allowClear' => true],
					],
					'filterInputOptions' => ['placeholder' => 'Status Rawat'], // allows multiple authors to be chosen
					'format' => 'raw'
					],
					
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{asesmen}',
						'buttons' => [
								
								'asesmen' => function ($url,$model) {
										if($model->batal != 1){
										return Html::a(
												'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
												$url);
										}
								},
								
								
														
							
								
							],
					],
					
	
					
				],
			]); ?>
		
	</div>