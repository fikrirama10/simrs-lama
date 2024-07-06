<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use common\models\Pasien;
/* @var $this yii\web\View */
/* @var $searchModel common\models\RawatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rawats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rawat-index" style='margin-top:20px;'>


    <div class='panel panel-default'>
		<div class='panel-body'>
			
			<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

			<p class='pull-right'>
			
			</p>

			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],

					//'Id',
					[
						'attribute' => 'Pasien',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
						    $pasien = Pasien::find()->where(['no_rekmed'=>$model->rm])->one();
						    if($pasien){
						        return $pasien->nama_pasien;
						    }
						},
					],
					 'rm',
					 'idrawat',
					 
					[
						'attribute' => 'Dikirim Dari',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->jer->jenisrawat;
						},
					],
					[
						'attribute' => 'Ket',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->ket;
						},
					],
					// 'deskripsi',
					//'Link',
					// 'IsActive',
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{rawatinap} {delete} ',
						'buttons' => [
								
								'rawatinap' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary">Rawat</span>', 
												$url);
								},
														
								'delete' => function ($url,$model) {
										return Html::a(
												'<span class="label label-danger">Delete</span>', 
												$url,
												[
												'title' => Yii::t('yii', 'Delete'),
												'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
												'data-method' => 'post',
												]);
								},
																

						
								
								
							],
					],

					
				],
			]); ?>
		</div>
	</div>
    
</div>
