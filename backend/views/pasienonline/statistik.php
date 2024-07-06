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
					[
						'attribute' => 'Jenis Rujukan',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							if($model->jenisreferensi == 1){
								return 'Nomor Rujukan';
							}else{
								return 'Nomor Kontrol';
							}
						},
					],
					[
						'attribute' => 'Nama Pasien ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->pasien->nama_pasien;
						},
					],
					[
						'attribute' => 'Nomor Hp ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->pasien->nohp;
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
						'attribute' => 'Status',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							if($model->verived == 0){
								return "<span class='label label-warning'>Belum Varifikasi</span>";
							}else if($model->verived == 1){
								return "<span class='label label-success'>Terlayani</span>";
							}else{
								return "<span class='label label-danger'>Batal</span>";
							}
						},
					],
					
				],
			]); ?>
		</div>
	</div>
</div>
