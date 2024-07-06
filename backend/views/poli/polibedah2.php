<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\date\DatePicker;
$this->title = 'Pasien Rawat';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-body'>
		<h2>Pasien Poli Bedah </h2><hr>
		<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
			
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				// 'hover' => true,
				// 'bordered' =>true,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'RM',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							if($model->anggota == 1){
								return $model->no_rekmed.'<span class="label label-success">Anggota</span>';
							}else{
								return $model->no_rekmed;
							}
						},
					],
					[
						'attribute' => 'No rawat ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->idrawat;
						},
					],
					[
						'attribute' => 'Nama Pasien ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->pasien->nama_pasien;
						},
					],
					
					
					
					[
						'attribute' => 'Tanggal Daftar',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return date('d F Y , G:i A',strtotime($model->tgldaftar));
						},
					],
					[
						'attribute' => 'DPJP',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->iddokter;
						},
					],
					[
						'attribute' => 'Jenis Rawat',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->polii->namapoli;
						},
					],
					[
						'attribute' => 'Bayar',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
						
								return $model->carabayar->jenisbayar;
							
						},
					],
					
					[
						'attribute' => 'Status',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
						if($model->idkb == 1){
							return '<span class="label label-primary">Baru</span>';
						}else{
							return '<span class="label label-warning">P Kontrol</span>';
						}
							
						},
					],
					[
						'attribute' => 'Diagnosa Awal',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							if($model->kdiagnosa == null){
								return '-';
							}else{
								return $model->kdiagnosa;
							}
						},
					],
					[
						'attribute' => 'Status',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							if($model->status == 1){
								return '<span class="label label-danger">Antrian</span>';
							}else if($model->status == 2){
								return '<span class="label label-warning">Pemeriksaan</span>';
							}else if($model->status == 3){
								return '<span class="label label-warning">Selesai</span>';
							}
						},
					],
					
					
					
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{asesmen}',
						'buttons' => [
								
								'asesmen' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
												$url);
								},
								
								
														
							
								
							],
					],
					
	
					
				],
			]); ?>
		
	</div>