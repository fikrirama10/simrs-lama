<?php
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\web\View;
use common\models\BarangMasukdetail;
use common\models\Obat;
/* @var $this yii\web\View */
/* @var $model common\models\BarangMasuk */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Barang Masuk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$brgMskc = BarangMasukdetail::find()->where(['idtrx'=>$model->idtrx])->count();
$brgMsk = BarangMasukdetail::find()->where(['idtrx'=>$model->idtrx])->all();
$no = 1;
$gridcolom = [
		['class' => 'kartik\grid\SerialColumn'],
		'obat.namaobat',
		'qty',
		'obat.satuan.satuan',
		'obat.hargabeli',
	    [	
					'attribute' => 'Jumlah ',
					'format' => 'raw',
					'value' => function ($model, $key, $index) { 
					    $obat = Obat::findOne($model->id);
					    if($obat){
						return $model->obat->hargabeli * $model->qty;
					    }
					},
			],
		[
		'class' => 'yii\grid\ActionColumn',
		'template' => '{view-rajal}',
		'buttons' => [
		'view-rajal' => function ($url,$model) {
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
                  
                         ExportMenu::FORMAT_EXCEL => ['filename' => 'Penerimaan_Barang-'.$model->idtrx],
                     ],
        'filename' => 'Penerimaan_Barang-'.$model->idtrx,
		]);
?>
<div class="barang-masuk-view">
	
	<div class="box box-body">
	
		<table class='table table-bordered'>
			<tr>
				<td>Tanggal</td>
				<td>: <?= $model->tanggal?></td>
			</tr>
			<tr>
				<td>Faktur</td>
				<td>: <?= $model->faktur?></td>
			</tr>
			<tr>
				<td>Jenis Barang</td>
				<td>: <?= $model->bayar->jenisbayar?></td>
			</tr>
			<tr>
				<td>Total Harga</td>
				<td>: <?= 'Rp. '.Yii::$app->algo->IndoCurr($model->total)?></td>
			</tr>
		</table>
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
