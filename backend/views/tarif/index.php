<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Jenistarif;
use common\models\JenispenerimaanDetail;
/* @var $this yii\web\View */
/* @var $searchModel common\models\TarifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tarif';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tarif-index">
<div class="box box-body">

    <h1><?= Html::encode($this->title) ?></h1>
    

    <p>
        <?= Html::a('Buat Tarif', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'nama',
            'tarif',
            'bayar.jenisbayar',
            [
				'attribute' => 'Jenis Tarif',
				'format' => 'raw',
				'value' => function ($model, $key, $index) { 
					$jenis = Jenistarif::find()->where(['id'=>$model->jenistarif])->count();
					if($jenis > 0){
						return $model->jenis->jenistarif;
					}
				},
			],
			[
				'attribute' => 'Jenis Terima',
				'format' => 'raw',
				'value' => function ($model, $key, $index) { 
					$jenis = JenispenerimaanDetail::find()->where(['id'=>$model->jenisterima])->count();
					if($jenis > 0){
						return $model->terima->namapenerimaan;
					}
				},
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
