<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BarangMasukSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Barang Masuk';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barang-masuk-index">
<div class="box box-body">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            'faktur',
            [	
					'attribute' => 'Tanggal Masuk',
					'format' => 'raw',
					'value' => function ($model, $key, $index) { 
						return date('Y/m/d',strtotime($model->tanggal));
					},
			],
			[	
					'attribute' => 'Jenir Barang',
					'format' => 'raw',
					'value' => function ($model, $key, $index) { 
						return $model->bayar->jenisbayar;
					},
			],
            [	
					'attribute' => 'Status',
					'format' => 'raw',
					'value' => function ($model, $key, $index) { 
						if($model->status == 1){
							return 'Selasai';
						}else{
							return 'Belum Selesai'; 
						}
						
					},
			],
			 [	
					'attribute' => 'Total Pembelanjaan',
					'format' => 'raw',
					'value' => function ($model, $key, $index) { 
						return 'Rp. '.Yii::$app->algo->IndoCurr($model->total);
					},
			],
			[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{barang-view}',
						'buttons' => [
								
								'barang-view' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
												$url);
								},
								
														
							
								
								
							],
					],
            //'total',

        ],
    ]); ?>
</div>
</div>
