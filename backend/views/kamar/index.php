<?php

use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = 'Semua Ruangan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aspirasi-index" style='margin-top:20px;'>
	<div class='box box-default'>
		<div class='box-header with-border'>
			<h3>
				<?= Html::encode($this->title)?>
				<p class='pull-right'>
					<?= Html::a('<i class="fa fa-plus"></i> Tambah Kamar',['/kamar/create'],['class' => 'btn btn-primary']);?>
				</p>
			</h3>
		</div>
		
		<div class='box-body'>
			<div class='col-md-12'>
		
		</div>
		<?php //echo $this->render('_search', ['model' => $searchModel]); ?>
			
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'hover' => true,
				'bordered' =>false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'Nama Ruangan',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->namaruangan;
						},
					],
					[
						'attribute' => 'Kelas ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->kelas->namakelas;
						},
					],
					[
						'attribute' => 'Tarif / Hari ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->kelas->tarif_hari;
						},
					],
					[
						'attribute' => 'Tempat Tidur ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->tempattidur;
						},
					],
					[
						'attribute' => 'Terisi ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->masuk;
						},
					],
					[
						'attribute' => 'Status ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							$ket = $model->tempattidur - $model->masuk;
							if($ket <= 0){
								return '<span class="label label-danger">Penuh</span>';
							}else{
								return '<span class="label label-success">Kosong</span>';
							}
						},
					],
				
					
				
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view} {update} {delete}',
						'buttons' => [
								
								'view' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
												$url);
								},
								
								
														
								'update' => function ($url,$model) {
										return Html::a(
												'<span class="label label-success"><span class="fa fa-pencil"></span></span>', 
												$url);
								},
																
								'delete' => function ($url,$model) {
										return Html::a(
												'<span class="label label-danger"><span class="fa fa-trash"></span></span>', 
												$url,
												[
												'title' => Yii::t('yii', 'Delete'),
												'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
												'data-method' => 'post',
												]);
								},
								
							],
					],
					
	
					
				],
			]); ?>
		</div>
	</div>
</div>
