<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use common\models\Radmcu;
/* @var $this yii\web\View */
/* @var $searchModel common\models\RadmcuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Radmcus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="radmcu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Radmcu', ['perikradmcu'], ['class' => 'btn btn-success']) ?>
    </p>
	<div class='box box-body'>


				<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'hover' => true,
				'bordered' =>false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'Nama Pasien',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->nama;
						},
					],
					
					[
						'attribute' => 'Jenis Pemeriksaan',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->drad->jenispemeriksaan;
						},
					],

					[
						'attribute' => 'Usia',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->usia;
						},
					],
						[
						'attribute' => 'Status',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							$detail = Radmcu::find()->where(['id'=>$model->id])->one();
							if($detail->status == 0){
								return '<span class="label label-danger">Belum Di Test</span>';
							}else{
								return '<span class="label label-success">Sudah Di Test</span>';
							}
						},
					],
					[
						'attribute' => 'Tanngal',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->tanggal;
						},
					],

				
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view}{update}',
						'buttons' => [
								
								'view' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
												Url::to(['radiologi/viewmcu/'.$model->id]));
								},
								'update' => function ($url,$model) {
										return Html::a(
												'<span class="label label-warning"><span class="fa fa-pencil"></span></span>', 
												Url::to(['radiologi/perikraupdate/'.$model->id]));
								},
								
								
								
							],
					],
					
	
					
				],
			]); ?>
</div>
</div>
