<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;
use yii\helpers\Url;


$this->title = 'Obat';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-index">
	<div class='panel panel-default'>
		<div class='panel-body'>
	
			
			<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
            <?= Html::a("<i class='fa fa-print'></i> Print Barang", ['print'], ['class' => 'btn btn-warning  mbot10','target'=>'_blank']) ?>
			<p>
				<?= Html::a("<i class='fa fa-plus-square-o'></i> Tambah Barang", ['create'], ['class' => 'btn btn-success pull-right mbot10']) ?>
			</p>

			<?= GridView::widget([
				'dataProvider' => $dataProvider,
			   
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],

					//'Id',
					
					[
						'attribute' => 'Nama Barang',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return Html::a('<b>'.$model->namaobat.'</b>', ['update', 'id' => $model->id]);
						},
					],
						[
						'attribute' => 'ED',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
						    if($model->kadaluarsa == null){
						        return '0000-00-00';
						    }else{
						        return $model->kadaluarsa;
						    }
							return $model->kadaluarsa;
						},
					],
					[
						'attribute' => 'Harga Jual',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->harga;
						},
					],
					[
						'attribute' => 'Harga Beli',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->hargabeli;
						},
					],
					[
						'attribute' => 'Stok',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->stok.' - '.$model->satuan->satuan;
						},
					],
					
[
						'attribute' => 'idjenis',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->idjenis;
						},
					],
					

					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view}{tambah}{kurangi}{delete}',
						'buttons' => [
								
								'view' => function ($url,$model) {
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
									
								'delete' => function ($url,$model) {
										return Html::a(
												' <span class="label label-danger"><span class="fa fa-trash"></span></span>', 
												$url);
								},
														
							
								
								
							],
					],
				],
			]); ?>
		<a class="label label-danger">Nama obat</a> = Obat High Allert
		</div>
		
	</div>
</div>
