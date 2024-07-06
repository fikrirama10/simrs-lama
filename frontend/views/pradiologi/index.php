<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use common\models\Pasien;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PradiologiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Indikator Klinis 3 Pasien Igd (Pelayanan Radiologi)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pradiologi-index">
<div class='box box-body table-responsive' style='margin-top:20px;'>
		  <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a(' + ', ['create'], ['class' => 'btn btn-success']) ?>
    	
				<?= GridView::widget([
				'dataProvider' => $dataProvider,
				// 'filterModel' => $searchModel,
				'id' => 'ajax_gridview',
				'hover' => true,
				'bordered' =>true,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'Tanggal',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return date('d F Y',strtotime($model->tanggal));
						},
					],
					[
						'attribute' => 'Nama Pasien',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							$pasien=Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->all();
							if($pasien == null){
								return'-';
							}else{
								return $model->pasien->nama_pasien;
							}
							
						},
					],
					[
						'attribute' => 'Usia',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							$pasien=Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->all();
							if($pasien == null){
								return'-';
							}else{
								return $model->pasien->usia;
							}
						},
					],
					[
						'attribute' => 'no rm',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->no_rekmed;
						},
					],
					[
						'attribute' => 'Jam Diambil ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							return $model->jamdiambil;
						},
					],
					[
						'attribute' => 'Jam Hasil',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							return $model->jamhasil;
						},
					],
					[
						'attribute' => 'Durasi (menit) ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							return $model->durasi.' menit';
						},
					],
					[
						'attribute' => 'Standar',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							return '< 60 menit';
						},
					],
					[
						'attribute' => 'Ket',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							if($model->durasi < 60){
								return '<span class="label label-success">Memenuhi</span>';
							}else{
								return '<span class="label label-danger">Tidak Memenuhi</span>';
							}
						},
					],
					[
						'attribute' => 'Jenis Pemeriksaan ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->periksa->jenispemeriksaan;
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
