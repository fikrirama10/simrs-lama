	<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\grid\GridView;
use common\models\Pasien;
if($hitung == 0){echo $total = 0;}else{

$suml = 0;
foreach($rad as $i)
{  
   $suml+= $i->tepat;
}
$hhh = $suml/$hitung;
$total = floor($hhh*100);
}
?>

	<?= GridView::widget([
				'dataProvider' => $dataProvider,
				// 'filterModel' => $searchModel,
				'id' => 'ajax_gridview',
				'hover' => true,
				'bordered' =>true,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'Tanggal',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return date('d F Y',strtotime($model->tanggal));
						},
					],
					[
						'attribute' => 'Nama Pasien',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							$pasien=Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->all();
							if($pasien == null){
								return'-';
							}else{
								return $model->pasien->nama_pasien;
							}
							
						},
					],
					[
						'attribute' => 'Usia',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							$pasien=Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->all();
							if($pasien == null){
								return'-';
							}else{
								return $model->pasien->usia;
							}
						},
					],
					[
						'attribute' => 'no rm',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->no_rekmed;
						},
					],
					[
						'attribute' => 'Jam Diambil ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							return $model->jamdiambil;
						},
					],
					[
						'attribute' => 'Jam Hasil',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							return $model->jamhasil;
						},
					],
					[
						'attribute' => 'Durasi (menit) ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							return $model->durasi.' menit';
						},
					],
					[
						'attribute' => 'Standar',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							return '< 60 menit';
						},
					],
					[
						'attribute' => 'Ket',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							if($model->durasi < 60){
								return '<span class="label label-success">Memenuhi</span>';
							}else{
								return '<span class="label label-danger">Tidak Memenuhi</span>';
							}
						},
					],
					[
						'attribute' => 'Jenis Pemeriksaan ',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->periksa->jenispemeriksaan;
						},
					],
					
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{update}',
						'buttons' => [
						
															
								'update' => function ($url,$model) {
										return Html::a(
												'<span class="label label-warning"><span class="fa fa-pencil"></span></span>', 
												$url);
								},
																
								
								
							],
					],
					
	
					
				],
			]); ?>
						<div class="row">
		<div class="col-sm-5 col-xs-12 pull-right">
			<div class='panel panel-default'>
				<div class='panel-body'>
					<div class="row bold">
						<div class="col-xs-6 text-total">
							Persentase Ketepatan
						</div>
						<div class="col-xs-6 text-right text-total">
							<?= $total?>%
						</div>
						
					</div>
					<div class="row bold">
						<div class="col-xs-6 text-total">
							
						</div>
						<div class="col-xs-6 text-right text-total">
							<?php
								if($total < 100){echo'<label class="label label-danger">Tidak Memenuhi Standar</label>';}else{echo'<label class="label label-primary"> Memenuhi Standar</label>';}
							?>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>