<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;

$this->title = 'Obat';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-index">
	<div class='panel panel-default'>
		<div class='panel-body'>
	
			
			

	

			<?= GridView::widget([
				'dataProvider' => $dataProvider,
			   
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],

					//'Id',
		
					[
						'attribute' => 'No Faktur',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->nofaktur;
						},
					],
					[
						'attribute' => 'Suplier',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->supli->namasuplier;
						},
					],
					[
						'attribute' => 'Tanggal Order',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->tanggal;
						},
					],
					[
						'attribute' => 'Total Harga',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->total;
						},
					],
					[
						'attribute' => 'Total Bayar',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->bayar;
						},
					],
					[
						'attribute' => 'Sisa Bayar',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->sisabayar;
						},
					],
					[
						'attribute' => 'Status',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							if($model->status == 0){
								return'Belum Lunas';
							}else{
								return'Lunas';
							}
						},
					],
				

					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{belian}{tambah}{kurangi}{hapus}',
						'buttons' => [
								
								'belian' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
												$url);
								},
								'tambah' => function ($url,$model) {
										return Html::a(
												' <span class="label label-success"><span class="fa fa-plus"></span></span>', 
												$url);
								},
									
								'kurangi' => function ($url,$model) {
										return Html::a(
												' <span class="label label-warning"><span class="fa fa-minus"></span></span>', 
												$url);
								},
									
								'hapus' => function ($url,$model) {
										return Html::a(
												' <span class="label label-danger"><span class="fa fa-trash"></span></span>', 
												$url);
								},
														
							
								
								
							],
					],
				],
			]); ?>
		
		</div>
		
	</div>
</div>
