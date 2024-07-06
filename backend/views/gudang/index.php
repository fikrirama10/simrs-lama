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
	
			
			<?php  echo $this->render('_search', ['model' => $searchModel]); ?>

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
							if($model->idkat == 6){
							return'<a style="font-size:12px;" class="label label-danger">'. $model->namaobat.'</a>';
							}else{
							return $model->namaobat;
							}
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
							return $model->harga;
						},
					],
					[
						'attribute' => 'Stok Gudang',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							$jumlah = $model->stokgudang;
							return  $jumlah.' - '.$model->satuan->satuan;
						},
					],
					[
						'attribute' => 'Stok',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							$jumlah = $model->stok + $model->stokgudang;
							return  $jumlah.' - '.$model->satuan->satuan;
						},
					],
					[
						'attribute' => 'Kategori Obat',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->katego->kat;
						},
					],
				

					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view}{tambah}{kurangi}{hapus}',
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
									
								'hapus' => function ($url,$model) {
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
