<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use common\models\Ppi;
use common\models\Pasien;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PpiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'AUDIT IDO BUNDLE CHECKLIST';
$this->params['breadcrumbs'][] = $this->title;
$ppi = Ppi::find()->all();

?>
<div class="ppi-index">
				
    		<div class='box box-body'>
			<h1><?= Html::encode($this->title) ?></h1> 
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    	
				<?= GridView::widget([
				'dataProvider' => $dataProvider,
				// 'filterModel' => $searchModel,
				'id' => 'ajax_gridview',
				'hover' => true,
				'bordered' =>false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'Tanggal',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->tanggal;
						},
					],
					[
						'attribute' => 'Nama Pasien',
						'format' => 'raw',
						
						'value' => function ($model, $key, $index) { 
							$pasien = Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->one();
							if($pasien == false){
								return $model->no_rekmed;
							}else{
								return $model->pasien->nama_pasien;
							}
						},
					],
					[
						'attribute' => 'Pemasangan sesuai indikasi',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							if($model->sesuaiindikasi == 1){								
								return '<i class="fa fa-check"></i>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
						},
					],
					[
						'attribute' => 'APD tepat',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
						if($model->apdtepat == 1){								
								return '<i class="fa fa-check"></i>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
							
						},
					],
					[
						'attribute' => 'Pemasangan menggunakan alat steril',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
						if($model->alatsteril == 1){								
								return '<i class="fa fa-check"></i>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
						
						},
					],
					[
						'attribute' => 'Hand Higienei',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
						if($model->hh == 1){								
								return '<i class="fa fa-check"></i>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
						
						
						},
					],

					[
						'attribute' => 'SSegera Di lepas jika tidak indikasi',
						'format' => 'raw',
						'width' => '20px',
						'value' => function ($model, $key, $index) { 
							if($model->dilepas == 1){								
								return '<i class="fa fa-check"></i>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
						},
					],
					[
						'attribute' => 'Pengisian balaon sesuai ( 30 ml )',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							if($model->pengisianbalon == 1){								
								return '<i class="fa fa-check"></i>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
							
						},
					],
					[
						'attribute' => 'Fiksasi Kateter dengan plester',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							if($model->fiksasi == 1){								
								return '<i class="fa fa-check"></i>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
							
						},
					],
					[
						'attribute' => 'Urine Bag menggantung',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							if($model->urine == 1){								
								return '<i class="fa fa-check"></i>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
							
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

</div>
