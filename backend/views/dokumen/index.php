<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

use common\models\DokumenJenis;
use common\models\DokumenKategori;
use common\models\Skpd;

$this->title = 'Dokumen Informasi Publik';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dokumen-index">
	<div class='box box-primary'>
		<div class='box-header with-border'>
			<h4>
				<?= Html::encode($this->title);?>
				<p class='pull-right'>
				<?= Html::a('<i class="fa fa-edit"></i> Input Dokumen', ['create'], ['class' => 'btn btn-success mbot10']); ?>
				<?= Html::a('<i class="fa fa-print"></i> Cetak Laporan', ['report'], ['class' => 'btn btn-primary mbot10']); ?>
				
			
				</p>
			</h4>
		</div>
		<div class='box-body'>
			<?php   echo $this->render('_search', ['model' => $searchModel]); ?>

			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'options' =>['class' =>'table table-responsive'],
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					 
					[
						'label' => 'JUDUL',
						'attribute' => 'Judul',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return Html::a('<div class="fitcolumn">'.$model->Judul.'</div>', ['view', 'id' => $model->Id]);
						},
					],
					
					[
						'label' => 'JENIS',
						'attribute' => 'kategori.Kategori',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->kategori->Kategori;
						},
					],	
					[
						'label' => 'KATEGORI',
						'attribute' => 'jenis.Jenis',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->jenis->Jenis;
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
												'<span class="label label-danger"><span class="fa fa-close"></span></span>', 
												$url,
												[
												'title' => Yii::t('yii', 'Delete'),
												'data-confirm' => Yii::t('yii', 'Anda Yakin akan menghapus Data?'),
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


<?php
Modal::begin([
	'id' => 'mdLap',
	'header' => 'Cetak Laporan',
	'options'=>[
		'data-url'=>'cetakLaporan',
	],
]);?>
 
<div class='row'>
	<?php $form = ActiveForm::begin([
        'action' => ['report-print'],
        'method' => 'get',
		'options' =>['target' => '_blank'],
    ]); ?>
	<div class='col-sm-12'>
		
		<div class='col-sm-12'>
			<label>Jenis</label><br/>
			<?= Html::dropDownList('idjenis',null,ArrayHelper::map(DokumenKategori::find()->all(), 'Id', 'Kategori'),['prompt'=>'- Semua Jenis -','class' => 'form-control']);?>
		</div>
		
		<div class='col-sm-12'>
			<label>Kategori</label><br/>
			<?= Html::dropDownList('idkat',null,ArrayHelper::map(DokumenJenis::find()->all(), 'Id', 'Jenis'),['prompt'=>'- Semua Kategori -','class' => 'form-control']);?>
		</div>
				
		<div class='col-sm-12'>
			
		</div>
		<div class='col-sm-6'>
			<label>Tanggal Awal</label><br/>
			<?= DatePicker::widget([
					'name' => 'awal',
					'type' => DatePicker::TYPE_INPUT,
					'options' =>['placeholder' => 'Pilih Tanggal Awal'],
					'pluginOptions' => [
						'autoclose'=>true,
						'format' => 'yyyy-mm-dd'
					]
				]);
				?>
		</div>
		<div class='col-sm-6'>
			<label>Tanggal Akhir</label><br/>
			<?= DatePicker::widget([
					'name' => 'akhir',
					'type' => DatePicker::TYPE_INPUT,
					'options' =>['placeholder' => 'Pilih Tanggal Akhir'],
					'pluginOptions' => [
						'autoclose'=>true,
						'format' => 'yyyy-mm-dd'
					]
				]);
				?>
		</div>
		
		
		<?= Yii::$app->algo->renderSplit(20);?>
		<div class='col-sm-12'>
			<button class="btn btn-primary pull-right"><i class="fa fa-print"></i> Cetak Laporan</button>
		</div>
	</div>
	
	
		
	 <?php ActiveForm::end(); ?>
</div>