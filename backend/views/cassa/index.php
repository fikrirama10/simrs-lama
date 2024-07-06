<?php


use yii\helpers\Html;
use common\models\Pasien;
use common\models\Rawatjalan;
use kartik\grid\GridView;
use yii\helpers\Url;
use dosamigos\chartjs\ChartJs;
use yii\widgets\Pjax;
use yii\db\Query;
use yii\web\View;
use kartik\date\DatePicker;
use common\models\Jenisrawat;
use miloschuman\highcharts\Highcharts;
use common\models\Kamar;
use common\models\Dokter;
use common\models\Diagnosa;
use common\models\Rawat;
$this->title = 'Semua Pasien';
$this->params['breadcrumbs'][] = $this->title;
$jrawat = Jenisrawat::find()->all();
?>

<div class='box box-body'>

	<h4>Daftar Pasien Kasir</h4>



			  
			
	
	
		<div class="box-body table-responsive">
		<?php  echo $this->render('_search', ['model' => $searchModel]); ?>	
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				// 'filterModel' => $searchModel,
				'id' => 'ajax_gridview',
				'showPageSummary'=>true,
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
						'attribute' => 'No rawat ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
								if($model->sbayar == null){
								return Html::a($model->idrawat, Url::to(['cassa/uppulang/'.$model->id]));	
								}else{
								return Html::a($model->idrawat, Url::to(['cassa/view/'.$model->id]));
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
						'attribute' => 'Tanggal Daftar',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->tgldaftar;
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
						'attribute' => 'Status',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							if($model->sbayar == null){
								return '<span class="label label-danger">Belum Bayar</span>';
							}else{
								return '<span class="label label-success">Lunas</span>';
							}
						},
					],
					
					
					
					
				],
			]); ?>
			
		</div>

      
		
		<!-- /.box-body -->
		
		<!-- /.box-footer -->
	  </div>
</div>