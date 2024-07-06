<?php


use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use common\models\Pasien;
use kartik\date\DatePicker;
use yii\web\View ;
/* @var $this yii\web\View */
/* @var $searchModel common\models\RekamedisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rekamedis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rekamedis-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rekamedis', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<div class="box box-body">
    <?= GridView::widget([
				'dataProvider' => $dataProvider,
				// 'filterModel' => $searchModel,
				'id' => 'ajax_gridview',
				'hover' => true,
				'bordered' =>false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],
					[
						'attribute' => 'No Rekamedis',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
							return $model->no_rekmed;
						
							
						},
					],
					[
						'attribute' => 'Nama Pasien',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
							$pasien = Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
							if($pasien == 0){
								return 'Pasien Tidak ada / Sudah terhapus';
							}else{
							return $model->pasien->nama_pasien;
							}
							
						},
					],
					
					[
						'attribute' => 'Peminjam',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
							return $model->peminjam;
						
							
						},
					],
						[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{delete}',
						'buttons' => [
								
																
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
