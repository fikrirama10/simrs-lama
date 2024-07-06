<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Banners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index">
	<div class='panel panel-default'>
		<div class='panel-body'>
			
			<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

			<p class='pull-right'>
				<?= Html::a('Create Banner', ['create'], ['class' => 'btn btn-success']) ?>
			</p>

			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],

					//'Id',
					[
						'attribute' => 'Gambar',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return Html::img(Yii::$app->params['baseUrl'].'/frontend/images/banner/'.$model->gambar, ['alt'=>'no picture', 'class'=>'tb-grid img img-responsive']);
						},
					],
					'judul',
					'deskripsi',
					//'Link',
					// 'IsActive',
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view} {update} {delete} ',
						'buttons' => [
								
								'view' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
												$url);
								},
														
								'update' => function ($url,$model) {
										return Html::a(
												'<span class="label label-success"><span class="fa fa-pencil"></span></span>', 
												$url);
								},
																
								'delete' => function ($url,$model) {
										return Html::a(
												'<span class="label label-danger"><span class="fa fa-trash"></span></span>', 
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
