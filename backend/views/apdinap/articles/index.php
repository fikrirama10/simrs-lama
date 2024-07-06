<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-index">
	<div class='panel panel-default'>
		<div class='panel-body'>
	
			
			<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

			<p>
				<?= Html::a("<i class='fa fa-plus-square-o'></i> Create Articles", ['create'], ['class' => 'btn btn-success pull-right mbot10']) ?>
			</p>

			<?= GridView::widget([
				'dataProvider' => $dataProvider,
			   
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],

					//'Id',
					[
						'attribute' => 'Title',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return Html::a('<b>'.$model->Title.'</b><br/>'.StringHelper::truncateWords($model->SubTitle, 10, $suffix = '...', $asHtml = false ), ['view', 'id' => $model->Id]);
						},
					],
					//'SubTitle',
					//'Intro',
					//'Content:ntext',
					// 'Created',
					// 'UserId',
					['attribute' => 'category.Category'],
					// 'IdBlock',
					['label' => 'Status','attribute' => 'publicity.Publicity'],
					// 'IsStatic',
					// 'IsFeatured',
					// 'Picture',
					// 'IsHeadLine',
					// 'Tags',
					// 'SEO',
					// 'ReadCount',
					// 'LastUpdate',

					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view} {update} {delete} {link} {publish}',
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
												'<span class="label label-danger"><span class="fa fa-close"></span></span>', 
												$url,
												[
												'title' => Yii::t('yii', 'Delete'),
												'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
												'data-method' => 'post',
												]);
								},
								'link' => function ($url,$model) {
										if($model->IdPub == 2){
											return Html::a(
												'<span class="label label-warning"><span class="fa fa-pause"></span></span>', 
												'unpublish/'.$model->Id);
										}
										else{
											return Html::a(
												'<span class="label label-info"><span class="fa fa-play"></span></span>', 
												'publish/'.$model->Id);
										}
								},
								
								
							],
					],
				],
			]); ?>
		</div>
	</div>
</div>
