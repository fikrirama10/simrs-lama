<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use common\models\Ppi;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PpiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'INDIKATOR Klinis 5 (Kesalahan Medikasi) ';
$this->params['breadcrumbs'][] = $this->title;
$ppi = Ppi::find()->all();
?>
<div class="ppi-index">
				<h1><?= Html::encode($this->title) ?></h1>
    		<div class='box box-body table-responsive'>
				 
        <?= Html::a('+', ['create'], ['class' => 'btn btn-success']) ?>
    	
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
						'value' => function ($model, $key, $index) { 
							return $model->tanggal;
						},
					],
					[
						'attribute' => 'Nama Pasien',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->rm;
						},
					],
					[
						'attribute' => 'No RM',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->rm;
						},
					],
					[
						'attribute' => 'Jumlah Jenis Obat',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->jumlahjenis;
						},
					],
					[
						'attribute' => 'Bentuk Sediaan ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							if($model->bentuksediaan == 1){								
								return '<i class="fa fa-close"></i>';
							}else{
								return '';
							}
						},
					],
					[
						'attribute' => 'Dosis Obat ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							if($model->dosis == 1){								
								return '<i class="fa fa-close"></i>';
							}else{
								return '';
							}
						},
					],
					[
						'attribute' => 'Aturan Pakai ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							if($model->aturan == 1){								
								return '<i class="fa fa-close"></i>';
							}else{
								return '';
							}
						},
					],
					[
						'attribute' => 'Komposisi Obat',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							if($model->komposisi == 1){								
								return '<i class="fa fa-close"></i>';
							}else{
								return '';
							}
						},
					],
					[
						'attribute' => 'Jumlah KEsalahan ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							$salah = $model->bentuksediaan + $model->dosis + $model->aturan + $model->komposisi;
							$kesalahan= $salah*25;
							return $kesalahan.'%';
						},
					],
					
					
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{update}',
						'buttons' => [
						
															
								'update' => function ($url,$model) {
										return Html::a(
												'<span class="label label-warning"><span class="fa fa-pencil"></span></span>', 
												$url);
								},
																
								
								
							],
					],
					
	
					
				],
			]); ?>
		</div>
</div>
