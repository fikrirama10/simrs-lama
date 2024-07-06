<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ObatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rujukan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="obat-index">
<div class='container-fluid'>
	<h3>Rujukan</h3>
		<div class='row'>
			<div class='col-md-12 col-xs-12' >
				<div class='box box-body'>
					<?= Html::a('<i class="fa fa-plus"></i> ',['/rujukan/create'],['class' => 'btn btn-primary ']);?><br><label></label>
				<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'hover' => true,
				'bordered' =>false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'No Rujukan',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return substr($model->kode,-4).' / '.date('Y',strtotime($model->tanggal)).' / '.$model->bln.' / RS';
						},
					],
			        'no_rekmed',
		            'nama',
					[
						'attribute' => 'Usia',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->usia.' th';
						},
					],
					[
						'attribute' => 'JK',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->jk;
						},
					],
					[
						'attribute' => 'Diagosa',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->diagnosa;
						},
					],
					
					[
						'attribute' => 'Asal',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->asal;
						},
					],
					[
						'attribute' => 'Ke',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->ke;
						},
					],
					[
						'attribute' => 'Kebutuhan',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->kebutuhan;
						},
					],
					[
						'attribute' => 'Tanggal',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->tanggal;
						},
					],
					[
						'attribute' => 'Waktu',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->waktu;
						},
					],
					
					
					
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view} {create} {delete} {print}',
						'buttons' => [
								
								'view' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
												$url);
								},
								'create' => function ($url,$model) {
										return Html::a(
												'<span class="label label-success"><span class="fa fa-pencil"></span></span>', 
												$url);
								},
								'delete' => function ($url,$model) {
										return Html::a(
												'<span class="label label-danger"><span class="fa fa-close"></span></span>', 
												$url);
								},
								'print' => function ($url,$model) {
										return Html::a(
												'<span class="label label-warning"><span class="fa fa-print"></span></span>', 
												$url);
								},
								
								
								
							],
					],
					
	
					
				],
			]); ?>
			
				</div>
				
			</div>
		</div>
	</div>
   
	
</div>
