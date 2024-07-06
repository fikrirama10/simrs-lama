	<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use common\models\Pasien;
if($hitung == 0){echo $total = 0;}else{
$sum = 0;
$suml = 0;
foreach($asesmen as $i)
{
   $sum+= $i->anamesisi + $i->ass_psiko + $i->rx_fisik + $i->penunjang+$i->diagnosis+$i->rencanaasuhan+$i->evaluasi+$i->ttd;
   $suml+= $i->lengkap;
}
$hh = $sum/8;
$totall = floor($hh/$hitung*100);
$hhh = $suml/$hitung;
$total = floor($hhh*100);
}

	$i = 0;
	$j = 0;
	//$color = ['red'];
	
	if(count($bybulan) < 1){
		$bulan[] = [date('W')];
		
		if(count($rawat) < 1){
			$data[] = ['name' => 'perawatan', 'data' => [0], ];
		}else{
			foreach($rawat as $cb):
			
				$j++;
				$data[] = ['name' => $cb->tanggal, 'data' => [0], ];
			
			endforeach;
		}
	}else{
		$awal = date('W', mktime(0, 0, 0, date('m'), 1, date('Y')));
		$week = array();
		foreach($bybulan as $bl):
			$week = $bl->tanggal - $awal + 5 ;
			$bulan[] = 'Minggu ke '.$week;
			
		endforeach;
		foreach($rawat as $cb):
			$bybulan = $bybulan2;
			$i++;
			foreach($bybulan as $tr):
				$arraytr[$i][] = floor ($tr->jumlah / $tr->Cnt * 100)  ;
			endforeach;
			endforeach;
			

			$j++;
			$data[] = ['name'=>'Indikator',  'data' => $arraytr[$j], ];
	
	
	}
	


?>

	<?= \dosamigos\highcharts\HighCharts::widget([
		'clientOptions' => [
			'chart' => [
				'type' => 'line',
				'align'=> 'center'
			],
			'title'=> [
				'text'=> 'STATISTIK INDIKATOR AREA KLINIS 1 (Asesmenpasien)'.$title,
				'x'=> -30 //center
			],
			'subtitle'=> [
				'text'=> '',
				'x'=> -20
			],
			'xAxis'=> [
				'categories'=> $bulan
			],
			'yAxis'=> [
				'title'=> [
					'text'=> 'Jumlah Kepatuhan '
				],
				'plotLines'=> [[
					'value'=> 95,
					'width'=> 3,
					'color'=> 'red'
				]]
			],
			'tooltip'=> [
				'valueSuffix'=> ''
			],
		 'plotOptions'=>[
			'line'=> [
            'dataLabels'=> [
                'enabled'=> true
            ],
            'enableMouseTracking'=>false
        ]
    ],
			// 'legend'=> [
				// 'layout'=> 'vertical',
				// 'align'=> 'right',
				// 'verticalAlign'=> 'middle',
				// 'borderWidth'=> 0
			// ],
			'series' => $data
		]
	]);
	?>	
  <hr>	
  <?php Pjax::begin(); ?>
				<?= GridView::widget([
				'dataProvider' => $dataProvider,
				// 'filterModel' => $searchModel,
				'id' => 'ajax_gridview',
				'hover' => true,
				'bordered' =>false,
				'columns' => [
					['class' => 'kartik\grid\SerialColumn'],

					[
						'attribute' => 'Tanggal',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->tanggal;
						},
					],
				[
						'attribute' => 'Nama Pasien',
						'format' => 'raw',
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
						'attribute' => 'tanggal Lahir',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							$pasien=Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->all();
							if($pasien == null){
								return'-';
							}else{
								return $model->pasien->tanggal_lahir;
							}
							
						},
					],
					[
						'attribute' => 'RM',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
						
								return $model->no_rekmed;
							
							
						},
					],
					// [
						// 'attribute' => 'Anamesis',
						// 'format' => 'raw',
						// 'hAlign'=>'center',
						// 'value' => function ($model, $key, $index) { 
							// if($model->anamesisi == 1){								
								// return '<i class="fa fa-check"></i>';
							// }else{
								// return '<i class="fa fa-close"></i>';
							// }
						// },
					// ],
					
					[
						'attribute' => 'Indikator Penilaian',
						'format' => 'raw',
						'value' => function ($model, $key, $index) {
							
								return '<b>Presentase Kelengkapan Assesmen awal<br> medis pasien gawat darurat</b>';
							
						},
					],
					[
						'attribute' => 'Standar',
						'format' => 'raw',
						'value' => function ($model, $key, $index) {
							
								return '100%';
							
						},
					],
					[
						'attribute' => 'Kelengkapan',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
							$hasil = $model->anamesisi + $model->ass_psiko + $model->rx_fisik + $model->penunjang+$model->diagnosis+$model->rencanaasuhan+$model->evaluasi+$model->ttd;
							$total = ($hasil/8)*100;
						
								return floor($hasil).' / 8';//'<i class="fa fa-close"></i>';
							
						},
					],
					[
						'attribute' => 'Persentase kelengkapan',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
							$hasil = $model->anamesisi + $model->ass_psiko + $model->rx_fisik + $model->penunjang+$model->diagnosis+$model->rencanaasuhan+$model->evaluasi+$model->ttd;
							$total = ($hasil/8)*100;
						
								return floor($total).'%';//'<i class="fa fa-close"></i>';
							
						},
					],
					
					[
						'attribute' => 'Keterangan',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
							$hasil = $model->anamesisi + $model->ass_psiko + $model->rx_fisik + $model->penunjang+$model->diagnosis+$model->rencanaasuhan+$model->evaluasi+$model->ttd;
							$total = ($hasil/8)*100;
							if($total == 100){
								return Html::a('<span class="label label-success">Lengkap</span>', ['asesmenpasien/'.$model->id]);
							}else{
							return Html::a('<span class="label label-danger">Tidak Lengkap</span>', ['asesmenpasien/'.$model->id]);
							}
								//'<i class="fa fa-close"></i>';
							
						},
					],
					[
						'attribute' => 'Sempel',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
							if($model->sempel == 'Y'){
								return '<i class="fa fa-check"></i>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
							
						},
					],
					// [
						// 'attribute' => 'Pemerikasaan Fisik',
						// 'format' => 'raw',
						// 'hAlign'=>'center',
						// 'value' => function ($model, $key, $index) { 
							// if($model->rx_fisik == 1){								
								// return '<i class="fa fa-check"></i>';
							// }else{
								// return '<i class="fa fa-close"></i>';
							// }
						// },
					// ],
					
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
			<?php Pjax::begin(); ?>
			<div class="row">
		<div class="col-sm-5 col-xs-12 pull-right">
			<div class='panel panel-default'>
				<div class='panel-body'>
					<div class="row bold">
						<div class="col-xs-6 text-total">
							Persentase Kelengkapan
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