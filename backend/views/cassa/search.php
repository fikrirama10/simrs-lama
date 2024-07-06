<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\grid\GridView;
?>
<?= GridView::widget([
				'dataProvider' => $dataProvider,
				// 'filterModel' => $searchModel,
				'id' => 'ajax_gridview',
				'showPageSummary'=>true,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					//'Id',
					
					[
						'attribute' => 'TRX Id',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return Html::a($model->idtrx, Url::to(['cassa/view/'.$model->idrawat]));
						},
					],
					[
						'attribute' => 'No RM',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->no_rm;					
						},
					],
					[
						'attribute' => 'Nama Pasien',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->pasien->nama_pasien;
						},
					],
					[
						'attribute' => 'Tanggal',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->tglbayar;
						},
					],
					[
						'attribute' => 'Jenis Bayar',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->bayar->jenisbayar;
						},
					],
						[
						'attribute' => 'Total',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->total;
						},
					],
					[
						'attribute' => 'Jenis Rawat',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->rawat->jerawat->jenisrawat;
						},
					],

				


				],
			]); ?>