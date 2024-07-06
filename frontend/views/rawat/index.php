<?php

use yii\helpers\Html;
use kartik\grid\GridView;

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
							return $model->pasien->nama_pasien;
						},
					],
					 'rm',
					 'idrawat',
					 [
						'attribute' => 'Pengirim',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->dokter->namadokter;
						},
					],
					[
						'attribute' => 'Dikirim Dari',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->idp;
						},
					],
					// 'deskripsi',
					//'Link',
					// 'IsActive',
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{rawatinap} {update} ',
						'buttons' => [
								
								'rawatinap' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary">Rawat</span>', 
												$url);
								},
														
								'update' => function ($url,$model) {
										return Html::a(
												'<span class="label label-success">Rujuk</span>', 
												$url);
								},
																

						
								
								
							],
					],

					
				],
			]); ?>
		</div>
	</div>
    
</div>
