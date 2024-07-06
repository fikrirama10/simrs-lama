<?php
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $model common\models\BarangMasuk */
$no = 1;
$gridcolom = [
		['class' => 'kartik\grid\SerialColumn'],
		'no_rekmed',
		'pasien.nama_pasien',
		[
			'attribute' => 'NIK',
			'format' => 'raw',
			'value' => function ($model, $key, $index) { 
				return '"'.$model->pasien->no_identitas.'"';
			},
		],
		'pasien.nobpjs',
		'pasien.usia',
		'pasien.tanggal_lahir',
		[
			'attribute' => 'Kel',
			'format' => 'raw',
			'value' => function ($model, $key, $index) { 
				return $model->pasien->kel->nama;
			},
		],
		[
			'attribute' => 'Kec',
			'format' => 'raw',
			'value' => function ($model, $key, $index) { 
				return $model->pasien->kec->nama;
			},
		],
		[
			'attribute' => 'Kab',
			'format' => 'raw',
			'value' => function ($model, $key, $index) { 
				return $model->pasien->kab->nama;
			},
		],
		[
			'attribute' => 'Tahun',
			'format' => 'raw',
			'value' => function ($model, $key, $index) { 
				return date('Y',strtotime($model->tgldaftar));
			},
		],
		'tgldaftar',
		'diagket',
		'pasien.alamat',
		'kdiagnosa',
	    
		[
		'class' => 'yii\grid\ActionColumn',
		'template' => '{input}',
		'buttons' => [
		'input' => function ($url,$model) {
		return Html::a(
				'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
				$url);
		},
		],
		],

		];
		$fullExportMenu = ExportMenu::widget([
		'dataProvider' => $dataProvider,
		'columns' => $gridcolom,
		'target' => ExportMenu::TARGET_BLANK,
		'pjaxContainerId' => 'kv-pjax-container',
		'exportContainer' => [
		'class' => 'btn-group mr-2'
		],
		'dropdownOptions' => [
		'label' => 'Full',
		'class' => 'btn btn-outline-secondary',
		'itemsBefore' => [
		'<div class="dropdown-header">Export All Data</div>',
		],
		],
		'exportConfig' => [
                  
                         ExportMenu::FORMAT_EXCEL => ['filename' => 'Pasien TB'],
                     ],
        'filename' => 'Pasien TB 2021',
		]);
?>
<div class="barang-masuk-view">
	
	<div class="box box-body">
	
		
		<a href="javascript:window.history.go(-1);" class="btn btn-primary pull-right">Kembali</a>	
		<hr>
	<?= GridView::widget([
			'panel' => ['type' => 'default', 'heading' => 'Daftar Pasien'],
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'hover' => true,
				'bordered' =>false,
				'pjax'=>true,
				'panel' => [
				'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon glyphicon-list-alt"></i> Obat dan Alkes</h3>',
				'type'=>'warning',
				
				'after'=>Html::a('<i class="fas fa-redo"></i> Reset Grid', ['index'], ['class' => 'btn bg-navy']),
				
			],
			 'export' => [
					'label' => 'Page',
				],
    'exportContainer' => [
        'class' => 'btn-group mr-2'
    ],
	

    // your toolbar can include the additional full export menu
    'toolbar' => [
        '{export}',
        $fullExportMenu,
		],
						
						'columns' => $gridcolom,
					]); ?>

	</div>
</div>
