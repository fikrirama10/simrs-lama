<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\JadwaloprasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jadwaloprasis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-body">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Jadwaloprasi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php   echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'hover' => true,
				'bordered' =>false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'Kode Booking',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->kodebooking;
						},
					],
				
					[
						'attribute' => 'No RM',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->no_rekmed;
						},
					],
					[
						'attribute' => 'Nama Pasien',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->pasien->nama_pasien;
						},
					],
					
					[
						'attribute' => 'Tangggal Pelaksanaaan',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return date('d F Y',strtotime($model->tglpelaksanaan));
						},
					],
					[
						'attribute' => 'Jenis Tindakan',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->jenistindakan;
						},
					],
					[
						'attribute' => 'Jenis Poli',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->poli->namapoli;
						},
					],
					
				
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view}{update}{delete}',
						'buttons' => [
								
								'view' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
												Url::to(['radiologi/view/'.$model->id]));
								},
								'update' => function ($url,$model) {
										return Html::a(
												'<span class="label label-warning"><span class="fa fa-pencil"></span></span>', 
												Url::to(['radiologi/update/'.$model->id]));
								},
								'delete' => function ($url,$model) {
										return Html::a(
												'<span class="label label-danger"><span class="fa fa-trash"></span></span>', 
												Url::to(['/jadwaloperasi/delete/'.$model->id]),
												[
												'title' => Yii::t('yii', 'Delete'),
												'data-confirm' => Yii::t('yii', 'Are you sure to delete this  ?'),
												'data-method' => 'post',
												]);
								},
								
								
								
							],
					],
					
	
					
				],
			]); ?>
</div>
