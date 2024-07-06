<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use dosamigos\chartjs\ChartJs;
use kartik\grid\GridView;
use common\models\Rawatjalan;
use yii\helpers\StringHelper;
use hscstudio\chart\ChartNew;
$no = 1;
$titles = [];
$jumlah = [];
$laki = [];
$balita = [];
$anak = [];
$dewasa = [];
$lansia = [];
foreach($datadiag as $d)
{
	$lakik=Rawatjalan::find()->joinWith('pasien')->where(['kdiagnosa'=>$d->kdiagnosa])->andwhere(['pasien.jenis_kelamin'=>'L'])->count();
	$pr=Rawatjalan::find()->joinWith('pasien')->where(['kdiagnosa'=>$d->kdiagnosa])->andwhere(['pasien.jenis_kelamin'=>'P'])->count();
		$balita[] = Rawatjalan::find()->joinWith('pasien')->where(['kdiagnosa'=>$d->kdiagnosa])->andwhere(['between','pasien.usia',1,5])->count();
		$anak[] = Rawatjalan::find()->joinWith('pasien')->where(['kdiagnosa'=>$d->kdiagnosa])->andwhere(['between','pasien.usia',6,16])->count();
		$dewasa[] = Rawatjalan::find()->joinWith('pasien')->where(['kdiagnosa'=>$d->kdiagnosa])->andwhere(['between','pasien.usia',17,40])->count();
		$lansia[] = Rawatjalan::find()->joinWith('pasien')->where(['kdiagnosa'=>$d->kdiagnosa])->andwhere(['between','pasien.usia',41,200])->count();
		$crrjcd=Rawatjalan::find()->where(['kdiagnosa'=>$d->kdiagnosa])->count();
	    $titles[] =  StringHelper::truncateWords($d->kdiagnosa, 3,  $asHtml = false );
	    $jumlah[] = $crrjcd;
	    $laki[] = $lakik;
	    $perem[] = $pr;
}
?>

<div class="asesmenpasien-index">
           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li  class="active"><a href="#tab_1-1" data-toggle="tab">10 Diagnosa Terbanyak</a></li>
              <li><a href="#tab_2-2" data-toggle="tab">Jenis Kelamin</a></li>
              <li><a href="#tab_3-2" data-toggle="tab">Usia</a></li>
            
              <li class="pull-left header"><i class="fa fa-th"></i> </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1-1">
            	<div class='row'>
				<div class="col-md-3">
					a
				</div>
				<div class='col-md-6'>
					<?= ChartNew::widget([
					  'type'=>'bar', # pie, doughnut, line, bar, horizontalBar, radar, polar, stackedBar, polarArea
					  'title'=>'10 Diagnosa Terbanyak',
				
					    'labels'=>$titles,
					  'datasets' => [
						  ['title'=>'Diagnosa','data'=> $jumlah],
						
					  ],
										]);

					?>

									
				</div>
				</div>
				
			
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2-2">
    			<div class='row'>
				<div class="col-md-3">
					a
				</div>
				<div class='col-md-6'>
					<?= ChartNew::widget([
					  'type'=>'bar', # pie, doughnut, line, bar, horizontalBar, radar, polar, stackedBar, polarArea
					  'title'=>'10 Diagnosa Terbanyak Berdasarkan Jenis Kelamin',
				
					    'labels'=>$titles,
					  'datasets' => [
						  ['title'=>'L','data'=> $laki],
						  ['title'=>'P','data'=> $perem],
					  ],
										]);

					?>
				</div>
				</div>
				
			
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3-2">
               <div class='row'>
				<div class="col-md-3">
					a
				</div>
				<div class='col-md-6'>
                <?= ChartNew::widget([
					  'type'=>'bar', # pie, doughnut, line, bar, horizontalBar, radar, polar, stackedBar, polarArea
					  'title'=>'10 Diagnosa Terbanyak Berdasarkan Rentan Usia',
				
					    'labels'=>$titles,
					  'datasets' => [
						  ['title'=>'0 - 5 th','data'=> $balita],
						  ['title'=>'6 - 15 th','data'=> $anak],
						  ['title'=>'16 - 40 th','data'=> $dewasa],
						  ['title'=>'40 - ... th','data'=> $lansia],
					  ],
										]);

					?>
				 
              </div>
              </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          </div>



					