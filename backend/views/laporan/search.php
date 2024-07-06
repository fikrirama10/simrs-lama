<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\grid\GridView;
?>		

			<?= GridView::widget([
			'panel' => ['type' => 'success', 'heading' => 'Daftar Rawat Jalan'],
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'hover' => true,
				'bordered' =>false,
				
				
				'id' => 'ajax_gridview',
				'showPageSummary'=>true,
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
						'attribute' => 'Anggota',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							if($model->anggota == 1){
								return '<span class="label label-success">Anggota</span>';
							}else{
								
							}
						},
					],
					[
						'attribute' => 'No rawat ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
								return Html::a($model->idrawat, Url::to(['rawatjalan/previewpasien/'.$model->id]));
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
							return $model->tgldaftar;
						},
					],
				[
						'attribute' => 'Cek',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return  "<input type='checkbox' id='or' name='horns'>";
						},
					],
				
					
					
					
					
				],
			]); ?>