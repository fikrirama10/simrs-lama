<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ObatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Surat Sakit';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="obat-index">
<div class='container-fluid'>
	<h3>Surat Sakit</h3>
		<div class='row'>
			<div class='col-md-12 col-xs-12' >
				<div class='box box-body'>
					<?= Html::a('<i class="fa fa-plus"></i> ',['/suratsakit/create'],['class' => 'btn btn-primary ']);?><br><label></label>
				<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'hover' => true,
				'bordered' =>false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'No Surat',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return substr($model->nomor,-4).' / '.date('Y',strtotime($model->tanggal)).' / '.$model->bulan.' / RS';
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
						'attribute' => 'Jenis Kelamin',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->jk;
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
						'attribute' => 'Sampai',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->sampai;
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
