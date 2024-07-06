<?php

use yii\helpers\Html;
use common\models\Pasien;
use common\models\Rawatjalan;
use kartik\grid\GridView;
use yii\web\View;
use kartik\date\DatePicker;
use common\models\Kamar;
use yii\helpers\Url;
use common\models\Dokter;
use common\models\Diagnosa;
use common\models\Rawat;
$jumlahkamar = Kamar::find()->all();
$url = 'http://192.168.1.26/simrs/api/kamar';
        $content = file_get_contents($url);
        $json = json_decode($content, true);
?>
<div class='box box-body'>
<h4>Riwayat Pasien pulang</h4>
		<div class='row'>
			<div class='col-md-12 col-xs-12' >
				<div class='box box-body'>
				<?php  echo $this->render('_search2', ['model' => $searchModel]); ?>
				<?= GridView::widget([
				'dataProvider' => $dataProvider,
				//'filterModel' => $searchModel,
				'hover' => true,
				'bordered' =>false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'Pasien',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return ''.$model->pasien->nama_pasien.'<br><a><i> '.$model->idrawat.'</i></a>';
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
						'attribute' => 'DPJP',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							if($model->iddokter == 0){
								return ' - ';
							}else{
							return $model->dokter->namadokter;
							}
						},
					],
					[
						'attribute' => 'Ruangan',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
						
							return $model->kamar->namaruangan;
							
						},
					],
					[
						'attribute' => 'Tanggal Masuk',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return date('d F Y',strtotime($model->tgldaftar));
						},
					],
					[
						'attribute' => 'Jam Masuk',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return date('G:i A ',strtotime($model->tgldaftar));
						},
					],
					
					[
						'attribute' => 'Tanggal Keluar',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return date('d F Y',strtotime($model->tglkeluar));
						},
					],
					[
						'attribute' => 'Lama Rawat',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->lamarawat +1 .' Hari';
						},
					],
					
					
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{view}',
						'buttons' => [
								
								'view' => function ($url,$model) {
										return Html::a(
												'<span class="label label-primary"><span class="fa fa-folder-open"></span></span>', 
												Url::to(['rawatinap/'.$model->id]));
								},
								
								
								
							],
					],
					
	
					
				],
			]); ?>
			
				</div>
			</div>
		</div>
</div>