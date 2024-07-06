<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\Pasien;
$this->title = 'Daftar Transaksi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-index">
	<div class='panel panel-default'>
		<div class='panel-body'>
	
			
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
			   
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],

					//'Id',
					
					[
						'attribute' => 'TRX Id',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return Html::a($model->idtrx, Url::to(['cassa/view/'.$model->idrawat]));
						},
					],
					[
						'attribute' => 'No RM',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->no_rm;					
						},
					],
					[
						'attribute' => 'Nama Pasien',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
						$pasien = Pasien::find()->where(['no_rekmed'=>$model->no_rm])->count();
						if($pasien == 0){
							return 'pasien tidak ada';
						}
							return $model->pasien->nama_pasien;
						},
					],
					[
						'attribute' => 'Jenis Bayar',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->bayar->jenisbayar;
						},
					],
					[
						'attribute' => 'Total',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return 'Rp.'.Yii::$app->algo->IndoCurr($model->total);
						},
					],
					


				],
			]); ?>
		
		</div>
		
	</div>
</div>
