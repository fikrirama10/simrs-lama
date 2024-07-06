<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\grid\GridView;

	$i = 0;
	$j = 0;
	$color = ['#fb954f','#6faab0','#c4c24a','#f6b53f','#e94649', '#48aa9f'];
	
	if(count($bybulan) < 1){
		$bulan[] = [date('d')];
		
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
			$week = $bl->tanggal;// - $awal + 1 + 4;
			$bulan[] = ''. $week;
		endforeach;
		foreach($rawat as $cb):
			$bybulan = $bybulan2;
			$i++;
			foreach($bybulan as $tr):
				$arraytr[$i][] = (int) $tr->jumlah * 2 / $tr->Cnt;
			endforeach;
			endforeach;
			

			$j++;
			$data[] = ['name'=>'jumlah Pasien','data' => $arraytr[$j], ];
	
	
	}
	
	
?>
<div class='box box-body'>
<?= \dosamigos\highcharts\HighCharts::widget([
		'clientOptions' => [
			'chart' => [
				'type' => 'line'
			],
			'title'=> [
				'text'=> 'STATISTIK PPI',
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
					'value'=> 0,
					'width'=> 1,
					'color'=> '#808080'
				]]
			],
			'tooltip'=> [
				'valueSuffix'=> ''
			],
				
			'legend'=> [
				'layout'=> 'vertical',
				'align'=> 'right',
				'verticalAlign'=> 'middle',
				'borderWidth'=> 0
			],
			'series' => $data
		]
	]);
	?>

</div>
		
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
						'attribute' => 'IPCLN',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->ipc->nama;
						},
					],
					[
						'attribute' => 'Unit',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->uni->unit;
						},
					],
					[
						'attribute' => 'Person',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							return $model->person;
						},
					],
					[
						'attribute' => 'Momen 1 ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							if($model->momen1 == 1){								
								return '<i class="fa fa-check"></i>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
						},
					],
					[
						'attribute' => 'Momen 2 ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							if($model->momen2 == 1){								
								return '<i class="fa fa-check"></i>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
						},
					],
					[
						'attribute' => 'Momen 3 ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							if($model->momen3 == 1){								
								return '<i class="fa fa-check"></i>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
						},
					],
					[
						'attribute' => 'Momen 4 ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							if($model->momen4 == 1){								
								return '<i class="fa fa-check"></i>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
						},
					],
					[
						'attribute' => 'Momen 5 ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							if($model->momen4 == 1){								
								return '<i class="fa fa-check"></i>';
							}else{
								return '<i class="fa fa-close"></i>';
							}
						},
					],
					[
						'attribute' => 'Kepatuhan ',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							$cuci = $model->momen1 + $model->momen2 + $model->momen3 + $model->momen4 + $model->momen5 ;
							$hitung = $cuci/5*10;
							return $hitung.'';
							},
					],
					
					
					[
						'attribute' => 'Ket',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) { 
							$cuci = $model->momen1 + $model->momen2 + $model->momen3 + $model->momen4 + $model->momen5 ;
							$hitung = $cuci/5*10;
							if($hitung < 10){								
								return '<span class="label label-danger">Tidak Patuh</span>';
							}else{
								return '<span class="label label-success">Patuh</span>';
							}
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
		</div>
</div>
