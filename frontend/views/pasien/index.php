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
<?php 
	$crawat = Rawat::find()->count();
	if($crawat != 0){ 
	?>
	 <div class="callout callout-danger">
                <h4>Ada Pasien Ke Rawat Inap  </h4>

                <p>Segera Ubah Status Pasien ke rawat inap <a href='#'>Klik disini</a></p>
	</div><?php }else{echo"";}?>
	<div class='box box-default'>
<?php $id = (isset($_GET['id']));?>

		<div class='box-header with-border'>
			
			<h3>
				<?= Html::encode($this->title)?>
				<p class='pull-right'>
				
					 <?= Html::a('<i class="fa fa-plus"></i> Tambah pasien BPJS',['/pasien/pesertabpjs'],['class' => 'btn btn-success']);?>
					 	<?= Html::a('<i class="fa fa-plus"></i> Tambah pasien Umum',['/pasien/create'],['class' => 'btn btn-primary']);?>
				</p>
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
						'attribute' => 'RM',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->no_rekmed;
						},
					],
					[
						'attribute' => 'Nama Pasien ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->nama_pasien;
						},
					],
					[
						'attribute' => 'Nomor Hp ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->nohp;
						},
					],
					[
						'attribute' => 'Alamat ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->alamat;
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
							$hrj = Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->count();
							if($hrj < 1){
								return"Pasien Baru";
							}else{
								return"Pasien Lama";
							}
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
