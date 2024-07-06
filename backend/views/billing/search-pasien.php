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
				'pjax'=>true,
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
						    if($model->batal == 1){
						        return $model->pasien->nama_pasien.'<span class="label label-danger">Batal Berobat</span>';
						    }else{
						        return $model->pasien->nama_pasien;
						    }
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
						'attribute' => 'Jenis Rawat',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->jerawat->jenisrawat;
						},
					],
					[
						'attribute' => 'Jenis Bayar',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->carabayar->jenisbayar;
						},
					],
					[
						'attribute' => 'Status',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							if($model->sbayar == null){
								return '<span class="label label-danger">Belum Bayar</span>';
							}else{
								return '<span class="label label-success">Lunas</span>';
							}
						},
					],
					
					
					
					
				],
			]); ?>