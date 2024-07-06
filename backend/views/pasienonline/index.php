<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\Rawat;
use common\models\Rawatjalan;
$this->title = 'Pasien Online';
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
						'attribute' => 'Kode Booking',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->noregistrasi;
						},
					],
					[
						'attribute' => 'No Antrean',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->antrian;
						},
					],
					[
						'attribute' => 'Tgl Berobat',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return date('Y/m/d',strtotime($model->tglberobat));
						},
					],
					[
						'attribute' => 'Tgl Daftar',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return date('Y/m/d',strtotime($model->tanggal));
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
						'attribute' => 'No bpjs',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->nokartu;
						},
					],
					[
						'attribute' => 'No Rujukan / Surat Kontrol',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->norujukan;
						},
					],
					// [
						// 'attribute' => 'Jenis Rujukan',
						// 'format' => 'raw',
						// 'value' => function ($model, $key, $index) { 
							// if($model->jenisreferensi == 1){
								// return 'Nomor Rujukan';
							// }else{
								// return 'Nomor Kontrol';
							// }
						// },
					// ],
					[
						'attribute' => 'Nama Pasien ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->nama;
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
						'attribute' => 'Poli yang di tuju ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->polii->namapoli;
						},
					],
					
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{verivikasi}{batal}',
						'buttons' => [
								
								'verivikasi' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary">Verivikasi</span>', 
												$url);
								},
								'batal' => function ($url,$model) {
										return Html::a(
												'<span class="label label-danger">Batal</span>', 
												$url);
								},
								
								
								
								
							],
					],
					
	
	
					
				],
			]); ?>
		</div>
	</div>
</div>
