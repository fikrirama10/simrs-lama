<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use common\models\Ppi;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PpiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'INDIKATOR Unit 1 (Unit Gawat Darurat) ';
$this->params['breadcrumbs'][] = $this->title;
$ppi = Ppi::find()->all();
?>
<div class="ppi-index">
			<h1><?= Html::encode($this->title) ?></h1>
			<h6>=> Pemberi Pelayanan Gawat Darurat Mempunyai Sertifikat yang masih berlaku seperti BLS/PPGD/GELS/ALS</h6>
    		<div class='box box-body table-responsive'>
				 
        <?= Html::a('+', ['create'], ['class' => 'btn btn-success']) ?>
    	
				<?= GridView::widget([
				'dataProvider' => $dataProvider,
				// 'filterModel' => $searchModel,
				'id' => 'ajax_gridview',
				'hover' => true,
				'bordered' =>false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'Nama Petugas',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->namapetugas;
						},
					],
					[
						'attribute' => 'Jabatan',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->jab;
						},
					],
					[
						'attribute' => 'Sertifikat BLS',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							$dd = date('Y-m-d');
							$diff =strtotime($model->blshabis)-strtotime($dd);
							$hari = $diff/(60*60*24);
							if($model->bls == 1 && $hari > 0 ){
								return'<span class="label label-success">Tersedia</span> <span class="label label-primary">Berlaku</span>';
							}else if($model->bls == 1 && $hari < 0 ){
								return'<span class="label label-success">Tersedia</span> <span class="label label-danger">Tidak Berlaku</span>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
						},
					],
					[
						'attribute' => 'Sertifikat PPGD',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							$dd = date('Y-m-d');
							$diff =strtotime($model->ppgdhabis)-strtotime($dd);
							$hari = $diff/(60*60*24);
							if($model->ppgd == 1 && $hari > 0 ){
								return'<span class="label label-success">Tersedia</span> <span class="label label-primary">Berlaku</span>';
							}else if($model->ppgd == 1 && $hari  < 0 ){
								return'<span class="label label-success">Tersedia</span> <span class="label label-danger">Tidak Berlaku</span>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
						},
					],
					[
						'attribute' => 'Sertifikat GELS',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							$dd = date('Y-m-d');
							$diff =strtotime($model->gelshabis)-strtotime($dd);
							$hari = $diff/(60*60*24);
							if($model->gels == 1 && $hari > 0 ){
								return'<span class="label label-success">Tersedia</span> <span class="label label-primary">Berlaku</span>';
							}else if($model->gels == 1 && $hari < 0 ){
								return'<span class="label label-success">Tersedia</span> <span class="label label-danger">Tidak Berlaku</span>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
						},
					],
					[
						'attribute' => 'Sertifikat ALS',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							$dd = date('Y-m-d');
							$diff =strtotime($model->alshabis)-strtotime($dd);
							$hari = $diff/(60*60*24);
							if($model->als == 1 && $hari > 0 ){
								return'<span class="label label-success">Tersedia</span> <span class="label label-primary">Berlaku</span>';
							}else if($model->als == 1 && $hari < 0 ){
								return'<span class="label label-success">Tersedia</span> <span class="label label-danger">Tidak Berlaku</span>';
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
