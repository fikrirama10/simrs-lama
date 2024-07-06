<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PermintaanBarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permintaan Barangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permintaan-barang-index">
	<div class="box box-body">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			
            [
				'attribute' => 'Nomer Permintaan',
				'format' => 'raw',
				'value' => function ($model, $key, $index) { 
					return $model->idpermintaan;
				},
			],
			 [
				'attribute' => 'Tanggal',
				'format' => 'raw',
				'value' => function ($model, $key, $index) { 
					return date('Y/m/d',strtotime($model->tanggal));
				},
			],
			 [
				'attribute' => 'Total',
				'format' => 'raw',
				'value' => function ($model, $key, $index) { 
					return 'Rp '. Yii::$app->algo->IndoCurr($model->total);
				},
			],
			[
				'attribute' => 'Total',
				'format' => 'raw',
				'value' => function ($model, $key, $index) { 
					if($model->status == 1){
						return 'Draf';
					}else if($model->status == 2){
						return 'Pengajuan';
					}else if($model->status == 3){
						return 'Pengajuan dikirim';
					}else{
						return 'Selesai'; 
					}
				},
			],
			
            
            //'jenis',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
	</div>
</div>
