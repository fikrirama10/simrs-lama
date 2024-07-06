<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\grid\GridView;
use common\models\Pasien;

$i = 0;
	$j = 0;
	//$color = ['red'];
	
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
			$week = $bl->tanggal;
			$bulan[] = 'tgl - '.$week;
			// if($week == 0){
				// $bulan[] = 'Minggu 1';
				
			// }else if($week == 1){
				// $bulan[] = 'Minggu 2';
			// }else if($week == 2){
				// $bulan[] = 'Minggu 3';
			// }else if($week == 3){
				// $bulan[] = 'Minggu 4';
			// }else{
				// $bulan[] = 'Minggu ++';
			// }
			
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
				'text'=> 'STATISTIK INDIKATOR AREA SASARAN KESELAMATAN PASIEN 2<br> '.$title,
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
						'attribute' => 'RM',
						'format' => 'raw',
						'value' => function ($model, $key, $index) { 
							$pasien=Pasien::find()->where(['no_rekmed'=>$model->no_rekmed])->all();
							if($pasien == null){
								return'-';
							}else{
								return $model->no_rekmed;
							}
							
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
						'attribute' => 'Diagnosa',
						'format' => 'raw',
						'hAlign'=>'left',
						'value' => function ($model, $key, $index) {
							
								return $model->diagnosa;
							
						},
					],
					
					[
						'attribute' => 'Kepatuhan Transfer Pasien',
						'format' => 'raw',
						'hAlign'=>'center',
						'value' => function ($model, $key, $index) {
							if($model->kepatuhan == 1){
								return '<span class="label label-success">patuh</span>';
							}else{
								return '<span class="label label-danger">Tidak patuh</span>';
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