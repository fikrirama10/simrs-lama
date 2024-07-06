<?php

use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = 'Semua Petugas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aspirasi-index" style='margin-top:20px;'>
	<div class='box box-default'>
		<div class='box-header with-border'>
			<h3>
				<?= Html::encode($this->title)?>
				<p class='pull-right'>
					<?= Html::a('<i class="fa fa-plus"></i> Tambah Petugas',['/user/create'],['class' => 'btn btn-primary']);?>
					<?= Html::a('<i class="fa fa-plus"></i> Print Petugas',['/user/report'],['class' => 'btn btn-primary']);?>
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
						'attribute' => 'kode petugas',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->pegawai->nama_petugas;
						},
					],
					[
						'attribute' => 'Nama Petugas ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->pegawai->nohp;
						},
					],
					[
						'attribute' => 'Alamat ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->pegawai->alamat;
						},
					],
					[
						'attribute' => 'Username ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->username;
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
