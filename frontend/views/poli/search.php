<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use dosamigos\chartjs\ChartJs;
use kartik\grid\GridView;
use common\models\Rawatjalan;
use yii\helpers\StringHelper;
use hscstudio\chart\ChartNew;
$gigi = [];
$bedah = [];
$dalam = [];
$tulang = [];
$kandungan = [];
$anak = [];
$inapp = [];
$igdd = [];
$polii = [];

$gigi[] = $poligigi;	
$bedah[] = $polibedah;	
$kandungan[] = $polikandungan;	
$anak[] = $polianak;	
$dalam[] = $polidalam;	
$tulang[] = $politukang;	
$igdd[] = $igd;	
$inapp[] = $inap;	
$polii[] = $polik;	


?>

<div class="poli-index">
           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li  class="active"><a href="#tab_1-1" data-toggle="tab">IGD , Poliklinik , Rawat Inap</a></li>
              <li><a href="#tab_2-2" data-toggle="tab">Poli Klinik </a></li>
             
            
              <li class="pull-left header"><i class="fa fa-th"></i> </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1-1">
            	<div class='row'>
				
				<div class='col-md-6'>
		
					<?= ChartNew::widget([
					  'type'=>'bar', # pie, doughnut, line, bar, horizontalBar, radar, polar, stackedBar, polarArea
					  'title'=>'Poli , IGD , Rawat INap',
				
					  'labels'=>['Pasien Rawat'],
					  'datasets' => [
						  ['title'=>'Poliklinik','data'=> $polii],
						  ['title'=>'IGD','data'=> $igdd],
						  ['title'=>'Rawat Inap','data'=> $inapp],
						 

					  ],
					]);

					?>				
				</div>
				<div class="col-md-1">
					
				</div>
				<div class="col-md-4">
					<table class="table table-bordered" align="center">
						<tr>
						<th>Nama Rawat</th>
						<th>Jumlah Pasien</th>
						</tr>
						<tr>
							<td>IGD</td>
							<td><?= $igd ?> Pasien</td>
						</tr>
						<tr>
							<td>Poli Klinik</td>
							<td><?= $polik ?> Pasien</td>
						</tr>
						<tr>
							<td>Rawat Inap</td>
							<td><?= $inap ?> Pasien</td>
						</tr>
						<tr>
							<th>Total</th>
							<th><?= $inap+$igd+$polik ?> Pasien</th>
						</tr>
						
					</table>
				</div>
				</div>
				
			
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2-2">
    			<div class='row'>
			
				<div class='col-md-6'>
					<?= ChartNew::widget([
					  'type'=>'bar', # pie, doughnut, line, bar, horizontalBar, radar, polar, stackedBar, polarArea
					  'title'=>'Poli',
				
					  'labels'=>['Poliklinik',],
					  'datasets' => [
						  ['title'=>'Poli Gigi','data'=> $gigi],
						  ['title'=>'Poli Bedah','data'=> $bedah],
						  ['title'=>'Poli kandungan','data'=> $kandungan],
						  ['title'=>'Poli dalam','data'=> $dalam],
						  ['title'=>'Poli anak','data'=> $anak],

					  ],
					]);

					?>
				</div>
				<div class='col-md-1'></div>
				<div class='col-md-4'>
					<table class="table table-bordered" align="center">
						<tr>
						<th>Nama Poli</th>
						<th>Jumlah Pasien Poli Klinik</th>
						</tr>
						<tr>
							<td>Poli Kandungan</td>
							<td><?= $polikandungan ?> Pasien</td>
						</tr>
						<tr>
							<td>Poli Bedah</td>
							<td><?= $polibedah ?> Pasien</td>
						</tr>
						<tr>
							<td>Poli Dalam</td>
							<td><?= $polidalam ?> Pasien</td>
						</tr>
						<tr>
							<td>Poli anak</td>
							<td><?= $polianak ?> Pasien</td>
						</tr>
						<tr>
							<td>Poli Gigi</td>
							<td><?= $poligigi ?> Pasien</td>
						</tr>
						<tr>
							<td>Poli Tulang</td>
							<td><?= $politukang ?> Pasien</td>
						</tr>
						<tr>
							<th>Total</th>
							<th><?= $polikandungan+$polibedah+$polidalam+ $polianak+$poligigi+ $politukang ?> Pasien</th>
						</tr>
					</table>
						
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
               
				 
              </div>
              </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          </div>



					