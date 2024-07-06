<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\web\View;
use kartik\grid\GridView;
use dosamigos\chartjs\ChartJs;
use kartik\date\DatePicker;
use kartik\export\ExportMenu;

?>
<?php Pjax::begin(); ?>
<?= GridView::widget([
				'panel' => ['type' => 'primary', 'heading' => 'Daftar Pasien'],
				'dataProvider' => $dataProvider,
				'id'=>'ajax_gridview',
				//'filterModel' => $searchModel,
				'hover' => true,
				
				'bordered' =>false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'Nomor Resep',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->idtrx;
						},
					],
					
					[
						'attribute' => 'Nama',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->pasien->nama_pasien;
						},
					],
					[
						'attribute' => 'No RM',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->norm;
						},
					],
					[
						'attribute' => 'Tanggal Resep',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->tgl;
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
						'class' => 'yii\grid\ActionColumn',
						'template' => '{createresep}',
						'buttons' => [
								
								'createresep' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
												$url);
								},
								
								
								
							],
					],
					
	
					
				],
			]); ?>
			<?php Pjax::end(); ?>