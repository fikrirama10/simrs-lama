<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ObatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Obats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="obat-index">
<div class='container-fluid'>
	
		<div class='row'>
			<div class='col-md-12 col-xs-12' >
				<div class='box box-body'>
				
				
				<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
					<?= Html::a('<i class="fa fa-plus"></i> Tambah Obat',['/pasien/create'],['class' => 'btn btn-primary ']);?>
			
				<?= GridView::widget([
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'hover' => true,
				'bordered' =>false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					
					[
						'attribute' => 'Nama Obat',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->namaobat;
						},
					],
					
					
					[
						'attribute' => 'Stok ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->stok;
						},
					],
				
					[
						'attribute' => 'Satuan ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->satuan->satuan;
						},
					],
					
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view} {create} {delete}',
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
								
								
								
							],
					],
					
	
					
				],
			]); ?>
			
				</div>
				
			</div>
		</div>
	</div>
   
	
</div>
