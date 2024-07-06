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
$semua = Rawatjalan::find()->where(['idjenisrawat'=>1])->count();
$bulanini = Rawatjalan::find()->where(['DATE_FORMAT(tgldaftar,"%m")' => $bi])->andwhere(['idjenisrawat'=>1])->count();
$mingguini = Rawatjalan::find()->where(['between', 'DATE_FORMAT(tgldaftar,"%Y-%m-%d")', $mi , date('Y-m-d')])->andwhere(['idjenisrawat'=>1])->count();
$hariini = Rawatjalan::find()->where(['DATE_FORMAT(tgldaftar,"%Y-%m-%d")' => $now ])->andwhere(['idjenisrawat'=>1])->count();
$kandungan = Rawatjalan::find()->where(['idpoli'=>5])->andwhere(['idjenisrawat'=>1])->count();
$gigi = Rawatjalan::find()->where(['idpoli'=>1])->andwhere(['idjenisrawat'=>1])->count();
$bedah = Rawatjalan::find()->where(['idpoli'=>3])->andwhere(['idjenisrawat'=>1])->count();
$anak = Rawatjalan::find()->where(['idpoli'=>2])->andwhere(['idjenisrawat'=>1])->count();
$dalam = Rawatjalan::find()->where(['idpoli'=>4])->andwhere(['idjenisrawat'=>1])->count();
$perseenkandungan = (100/$semua)*$kandungan;
$perseengigi = (100/$semua)*$gigi;
$perseenbedah = (100/$semua)*$bedah;
$perseenanak = (100/$semua)*$anak;
$perseendalam = (100/$semua)*$dalam;
	$rawat = Rawatjalan::find()->where(['idjenisrawat'=>1])->orderBy(['tgldaftar'=>SORT_ASC])->all();
	$bybulan = Rawatjalan::find()->where(['idjenisrawat'=>1])->groupBy(['DATE_FORMAT(tgldaftar, "%M")','DATE_FORMAT(tgldaftar, "%Y")'])->orderBy(['tgldaftar'=>SORT_ASC])->all();
	
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
			$bybulan = Rawatjalan::find()->select(['DATE_FORMAT(tgldaftar, "%M")', 'COUNT(id) as Cnt'])->where(['idjenisrawat'=>1])->groupBy(['DATE_FORMAT(tgldaftar, "%M")','DATE_FORMAT(tgldaftar, "%Y")'])->orderBy(['tgldaftar'=>SORT_ASC])->all();
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

						  <p>Pasien POLIKLINIK</p>
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
		<div class='col-md-8'>
			<div class='box box-body'>
			<div class='col-lg-12'>
				<?= \dosamigos\highcharts\HighCharts::widget([
		'clientOptions' => [
			'chart' => [
				'type' => 'line'
			],
			'title'=> [
				'text'=> 'STATISTIK KUNJUNGAN PASIEN POLI KLINIK',
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
		
        <div class="col-md-4">
          <!-- Info Boxes Style 2 -->
          <div class="info-box bg-maroon">
            <span class="info-box-icon"><i class="fa fa-venus-mars"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Poli Kandungan</span>
              <span class="info-box-number"><?= $kandungan?></span>

              <div class="progress">
                <div class="progress-bar" style="width: <?= $perseenkandungan?>%"></div>
              </div>
              <span class="progress-description">
				<?= $perseenkandungan ?>%
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-blue">
            <span class="info-box-icon"><i class="fa fa-hotel"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Poli Bedah</span>
              <span class="info-box-number"><?= $bedah?></span>

              <div class="progress">
                <div class="progress-bar" style="width: <?= $perseenbedah?>$"></div>
              </div>
              <span class="progress-description">
                    <?= $perseenbedah?>%
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-child"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Poli Anak</span>
              <span class="info-box-number"><?= $anak?></span>

              <div class="progress">
                <div class="progress-bar" style="width: <?= $perseenanak ?>%"></div>
              </div>
              <span class="progress-description">
                     <?= $perseenanak?>%
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-grey">
            <span class="info-box-icon"><i class="fa fa-heartbeat"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Poli Dalam</span>
              <span class="info-box-number"><?= $dalam?></span>

              <div class="progress">
                <div class="progress-bar" style="width: <?= $perseendalam?>%"></div>
              </div>
              <span class="progress-description">
                    <?= $perseendalam?>% 
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
		   <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-optin-monster"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Poli Gigi</span>
              <span class="info-box-number"><?= $gigi?></span>

              <div class="progress">
                <div class="progress-bar" style="width: <?= $perseengigi?>%"></div>
              </div>
              <span class="progress-description">
                    <?= $perseengigi?>% 
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->

          

          <!-- PRODUCT LIST -->

          <!-- /.box -->
        </div>
	</div>
</div>