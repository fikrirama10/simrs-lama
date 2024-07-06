<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\date\DatePicker;
$this->title = 'Pasien Rawat';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-body'>
		
		<?php //echo $this->render('_search', ['model' => $searchModel]); ?>
			
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'hover' => true,
				'bordered' =>false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'RM',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->no_rekmed;
						},
					],
					[
						'attribute' => 'No rawat ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->idrawat;
						},
					],
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
					[
						'attribute' => 'Jenis Rawat',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->jerawat->jenisrawat;
						},
					],
					
					
					
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{previewpasien}',
						'buttons' => [
								
								'previewpasien' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
												$url);
								},
								
								
														
							
								
							],
					],
					
	
					
				],
			]); ?>
		
	</div>