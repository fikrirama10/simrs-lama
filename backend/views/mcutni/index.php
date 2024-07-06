<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\McutniSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mcutnis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mcutni-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mcutni', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Print', ['printtni'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nama',
            'nofoto',
            'notes',
            'usia',

            	[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view}{update}{delete}{printtni-id}',
						'buttons' => [
								
								'view' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
												$url);
								},
								'update' => function ($url,$model) {
										return Html::a(
												' <span class="label label-success"><span class="fa fa-plus"></span></span>', 
												$url);
								},
									
								'delete' => function ($url,$model) {
										return Html::a(
												' <span class="label label-danger"><span class="fa fa-trash"></span></span>', 
												$url);
								},
									
								'printtni-id' => function ($url,$model) {
										return Html::a(
												' <span class="label label-default"><span class="fa fa-print"></span></span>', 
												$url);
								},
														
							
								
								
							],
					],
        ],
    ]); ?>
</div>
