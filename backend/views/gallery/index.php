<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
/* @var $this yii\web\View */
/* @var $searchModel common\models\GalerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Galery';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="galery-index">
	<div class='panel panel-default'>
		<div class='panel-body'>
   
			<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

			<p>
				<?= Html::a('Upload', ['create'], ['class' => 'btn btn-success pull-right mbot10']) ?>
			</p>

			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],
					[
						'attribute' => 'Image',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return Html::img(Yii::$app->params['baseUrl'].'/frontend/images/gallery/thumbnail/'.$model->gambar, ['alt'=>'no picture', 'class'=>'tb-grid img img-responsive']);
						},
					],
					
					'judul',
					
					[
						'attribute' => 'deskripsi',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return StringHelper::truncateWords($model->deskripsi, 10, $suffix = '...', $asHtml = false );
						},
					],
					
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view} {update} {delete} {link}',
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
								'link' => function ($url,$model) {
										if($model->tampilkan == 1){
											return Html::a(
												'<span class="label label-warning"><span class="fa fa-pause"></span></span>', 
												'unpublish/'.$model->id);
										}
										else{
											return Html::a(
												'<span class="label label-info"><span class="fa fa-play"></span></span>', 
												'publish/'.$model->id);
										}
								},
							],
					],
				],
			]); ?>
		</div>
	</div>

</div>
