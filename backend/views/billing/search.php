<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\Pasien;
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
							return Html::a($model->idtrx, Url::to(['billing/view/'.$model->id]));
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
						    $pasienc = Pasien::find()->where(['no_rekmed'=>$model->no_rm])->count();
						    if($pasienc < 1){
						        return $model->no_rm;
						    }else{
							return $model->pasien->nama_pasien;
						    }
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
						    
						    if($model->idjenisrawat == null){
						        return $model->idjenisrawat;
						    }else{
							return $model->jenisrawat->jenisrawat;
						    }
						},
					],

				


				],
			]); ?>