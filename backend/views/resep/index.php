<?php

use yii\helpers\Html;
use kartik\grid\GridView;
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
				
							</h3>
		</div>
		<div class='col-md-12'>
			<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
		</div>
		<div class='box-body table-responsive'>
			
		<?php //echo $this->render('_search', ['model' => $searchModel]); ?>
			
			<?= GridView::widget([
				'panel' => ['type' => 'primary', 'heading' => 'Daftar Pasien'],
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'hover' => true,
				'bordered' =>false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'IdRawat',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->idrawat;
						},
					],
					[
						'attribute' => 'RM',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->no_rekmed;
						},
					],
					
					[
						'attribute' => 'Nama Pasien',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->pasien->nama_pasien;
						},
					],
					[
						'attribute' => 'Tgl Berobat',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->tgldaftar;
						},
					],
					[
						'attribute' => 'Poli',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							if($model->idjenisrawat == 1){
								return $model->polii->namapoli;
							}else if($model->idjenisrawat == 3){
								return "UGD";
							}else{
								return $model->kamar->namaruangan;
							}
						},
					],
					[
						'attribute' => 'Jenis Rawat',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->jerawat->jenisrawat;
						},
					],
					[
						'attribute' => 'Jenis Bayar',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->carabayar->jenisbayar;
						},
					],
					
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view}',
						'buttons' => [
								
								'view' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
												$url);
								},
								
								
								
							],
					],
					
	
					
				],
			]); ?>
		</div>
	</div>
</div>
