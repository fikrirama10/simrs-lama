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
$bi = date('m');
$now = date('Y-m-d');
$mi = date('Y-m-d',strtotime('-7 days',strtotime(date('Y-m-d h:i:s'))));
$semua = Rawatjalan::find()->where(['idjenisrawat'=>3])->count();
$bulanini = Rawatjalan::find()->where(['DATE_FORMAT(tgldaftar,"%m")' => $bi])->andwhere(['idjenisrawat'=>3])->count();
$mingguini = Rawatjalan::find()->where(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $mi , date('Y-m-d')])->andwhere(['idjenisrawat'=>3])->count();
$hariini = Rawatjalan::find()->where(['DATE_FORMAT(tgldaftar,"%m")' => $now ])->andwhere(['idjenisrawat'=>3])->count();
	$rawat = Rawatjalan::find()->where(['idjenisrawat'=>3])->orderBy(['tgldaftar'=>SORT_ASC])->all();
	$bybulan = Rawatjalan::find()->where(['idjenisrawat'=>3])->groupBy(['DATE_FORMAT(tgldaftar, "%M")','DATE_FORMAT(tgldaftar, "%Y")'])->orderBy(['tgldaftar'=>SORT_ASC])->all();
	
	$i = 0;
	$j = 0;
	$color = ['#fb954f','#6faab0','#c4c24a','#f6b53f','#e94649', '#48aa9f'];
	
	if(count($bybulan) < 1){
		$bulan[] = [date('M')];
		
		if(count($jenisrawat) < 1){
			$data[] = ['name' => 'perawatan', 'data' => [0], ];
		}else{
			foreach($rawat as $cb):
			foreach($jenisrawat as $cb):
				$j++;
				$data[] = ['name' => $cb->tgldaftar, 'data' => [0], ];
			endforeach;
			endforeach;
		}
	}else{
		foreach($bybulan as $bl):
			$bulan[] = date('F',strtotime($bl->tgldaftar));
		endforeach;
		foreach($rawat as $cb):
			$bybulan = Rawatjalan::find()->select(['DATE_FORMAT(tgldaftar, "%M")', 'COUNT(id) as Cnt'])->where(['idjenisrawat'=>3])->groupBy(['DATE_FORMAT(tgldaftar, "%M")','DATE_FORMAT(tgldaftar, "%Y")'])->orderBy(['tgldaftar'=>SORT_ASC])->all();
			$i++;
			foreach($bybulan as $tr):
				$arraytr[$i][] = (int) $tr->Cnt;
			endforeach;
			endforeach;
			

			$j++;
			$data[] = ['name'=>'jumlah Pasien','data' => $arraytr[$j], ];
	
		
	}
	
?>
<div class='container-fluid'>

	<div class='row'>
	
		<div class='col-md-12'>
			<div class='box box-body'>	
			<h4>Pasien IGD</h4><hr>			
				  <div class="col-lg-3 col-xs-6">
						<!-- small box -->
					  <div class="small-box bg-aqua">
						<div class="inner">
						  <h3><?= $semua?></h3>

						  <p>Pasien IGD</p>
						</div>
						<div class="icon">
						  <i class="fa fa-ambulance"></i>
						</div>
						
					  </div>
					</div>
					
					 <div class="col-lg-3 col-xs-6">
						<!-- small box -->
					  <div class="small-box bg-purple">
						<div class="inner">
						  <h3><?= $bulanini?></h3>

						  <p>Pasien Bulan ini</p>
						</div>
						<div class="icon">
						   <i class="fa fa-ambulance"></i>
						</div>
						
					  </div>
					</div>
					
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
					  <div class="small-box bg-yellow">
						<div class="inner">
						  <h3><?= $mingguini?></h3>

						  <p>Pasien Minggu ini</p>
						</div>
						<div class="icon">
						   <i class="fa fa-ambulance"></i>
						</div>
						
					  </div>
					</div>
					
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
					  <div class="small-box bg-green">
						<div class="inner">
						  <h3><?= $hariini?></h3>

						  <p>Pasien hari ini</p>
						</div>
						<div class="icon">
						 <i class="fa fa-ambulance"></i>
						</div>
						
					  </div>
					</div>
							
					
					
			
			</div>
			</div>
		</div>
		<div class='col-md-12'>
			<div class='box box-body'>
			<div class='col-lg-12'>
				<?= \dosamigos\highcharts\HighCharts::widget([
		'clientOptions' => [
			'chart' => [
				'type' => 'line'
			],
			'title'=> [
				'text'=> 'STATISTIK KUNJUNGAN PASIEN IGD',
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
					'text'=> 'Jumlah Pasien Daftar '
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
			</div>
		</div>
	</div>
</div>