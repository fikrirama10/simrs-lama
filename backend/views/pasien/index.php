<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\Rawat;
use common\models\Rawatjalan;
$this->title = 'Semua Pasien';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="aspirasi-index" style='margin-top:20px;'>

	<div class='box box-default'>
<?php $id = (isset($_GET['id']));?>

		<div class='box-header with-border'>
			
			<h3>
				<?= Html::encode($this->title)?>
				<p class='pull-right'>
				
					
					 	<?= Html::a('<i class="fa fa-plus"></i> Tambah pasien',['/pasien/create'],['class' => 'btn btn-danger']);?>
				</p>
							</h3>
		</div>
		<div class='col-md-12'>
		<hr>
			<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
		</div>
		<div class='box-body table-responsive'>
			
			
			<?= GridView::widget([
    			'dataProvider' => $dataProvider,
    			'filterModel' => $searchModel,

				'columns' => [
			
                    'no_rekmed',
		
					[
						'attribute' => 'Nama Pasien ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) {
						$rawaj= Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->andwhere(['diagket'=>'TB+'])->count();
						if($model->ketber == 'B20'){
							return Html::a('<h6><span class="label label-danger">'.$model->nama_pasien.'</span></h6>', ['view', 'id' => $model->id]);
						 }else if($rawaj >0){
							 return Html::a('<h6><span class="label label-warning">'.$model->nama_pasien.'</span></h6>', ['view', 'id' => $model->id]);
						
						}else{
							return Html::a('<b>'.$model->nama_pasien.'</b>', ['view', 'id' => $model->id]);
						}
						},
					],
					[
						'attribute' => 'Nomor Hp ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->nohp;
						},
					],
					'nobpjs',
				    'alamat',
					[
						'attribute' => 'Tanggal Lahir ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->tanggal_lahir;
						},
					],
					[
						'attribute' => 'Jenis Kelamin ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->jenis_kelamin;
						},
					],
					[
						'attribute' => 'Status Pasien',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->stpasien;
						},
					],
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view} {update} {delete}',
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
