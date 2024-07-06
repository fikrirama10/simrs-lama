<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OprasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Oprasis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oprasi-index">
	<div class='box box-body'>
		<?= GridView::widget([
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],
					'idoprasi',
					'no_rekmed',
					//'Id',
					[
						'attribute' => 'Nama Pasien',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->pasien->nama_pasien;
						},
					],
					
					 'idrawat',
					 // [
						// 'attribute' => 'Pengirim',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
							// return $model->dokter->namadokter;
						// },
					// ],
					// [
						// 'attribute' => 'Dikirim Dari',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
							// return $model->jer->jenisrawat;
						// },
					// ],
					// [
						// 'attribute' => 'Ket',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
							// return $model->ket;
						// },
					// ],
					// 'deskripsi',
					//'Link',
					// 'IsActive',
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view} ',
						'buttons' => [
								
								'view' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary">Oprasi</span>', 
												$url);
								},
														
								// 'update' => function ($url,$model) {
										// return Html::a(
												// '<span class="label label-success">Rujuk</span>', 
												// $url);
								// },
																

						
								
								
							],
					],

					
				],
			]); ?>
	</div>
</div>
