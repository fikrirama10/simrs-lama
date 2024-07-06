	<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use dosamigos\chartjs\ChartJs;
use kartik\grid\GridView;
$data[] = ['name' => 'Laki - Laki', 'data' => $laki , 'name' => 'Perempuan', 'data' => $perempuan ];
?>

<div class="col-md-12">
		  <div class="row">
		  <div class="col-md-12">
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li><a href="#tab_1-1" data-toggle="tab"> Jenis Kelamin</a></li>
              <li  class="active"><a href="#tab_2-2" data-toggle="tab">Umur</a></li>
              <li><a href="#tab_3-2" data-toggle="tab">Pekerjaan</a></li>
			<li><a href="#tab_5-2" data-toggle="tab">Kunjungan</a></li>
			
              <li class="pull-left header"><i class="fa fa-th"></i> </li>
            </ul>
			
            <div class="tab-content">
              <div class="tab-pane " id="tab_1-1">
				<div class='row'>
					<div class='col-md-8'>
					<?= ChartJs::widget([
						'type' => 'pie',
						'options' => [
							// 'height' => 100,
							// 'width' => 400
						],
						'data' => [
							'labels' => ["Laki Laki = ".$laki, "Perempuan = ".$perempuan],
							'datasets' => [
								[
									'data' => [$laki, $perempuan,],
									'backgroundColor' => [
										"#fb954f",
										"#36A2EB",
										"#FF6384",
										"#FFCE56"
									],
									'hoverBackgroundColor' => [
										"#fb954f",
										"#36A2EB",
										"#FF6384",
										"#FFCE56"
									]
								]
							]
						]
					]);
					?>
						
					</div>
					<div class='col-md-4'>
						  <table class="table table-hover">
							<tr>
							  <th>Laki</th>
							  <th>Perempuan</th>
							 
							</tr>
							
							<tr>
							<td><?= $laki?> orang</td>
							<td><?= $perempuan ?> orang</td>
							</tr>
							
							

						  </table>
					</div>
				</div>
				
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tab_2-2">
			  <div class='row'>
				<div class='col-md-8'>
				<?= ChartJs::widget([
					'type' => 'bar',
					
					'data' => [
						'labels' => ["0 - 5 th = ".$balita." orang", "5 - 16 th = ".$anak." orang", "17 - 40 th = ".$dewasa." orang", "41 - ... th = ".$lansia." orang"],
						'datasets' => [
							[
								
								'data' => [$balita,$anak,$dewasa,$lansia],
								'backgroundColor' => [
									"#fb954f",
									"#36A2EB",
									"#FF6384",
									"#FFCE56"
								],
								'hoverBackgroundColor' => [
									"#fb954f",
									"#36A2EB",
									"#FF6384",
									"#FFCE56"
								]
							]
						]
					]
				]);
				?>
				</div>
				<div class='col-md-4'>
				<table class="table table-hover">
							<tr>
							  <th>0 - 5 th</th>
							  <th>6 - 16 th</th>
							  <th>17 - 40 th</th>
							  <th>41 - ... th</th>
							 
							</tr>
							
							<tr>
							<td><?= $balita?> orang</td>
							<td><?= $anak ?> orang</td>
							<td><?= $dewasa ?> orang</td>
							<td><?= $lansia ?> orang</td>
							</tr>
							
							

						  </table>
				</div>
			  </div>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3-2">
			  <div class='row'>
				<div class='col-md-8'>
					<?= ChartJs::widget([
						'type' => 'bar',
						
						'data' => [
							'labels' => ["TNI AU = ".$au." orang", "TNI AL = ".$al." orang", "TNI AD = ".$ad." orang", "PNS = ".$pns." orang", "Umum = ".$umum." orang"],
							'datasets' => [
								[
									
									'data' => [$au,$al,$ad,$pns,$umum],
									'backgroundColor' => [
										"#fb954f",
										"#36A2EB",
										"#FF6384",
										"#FFCE56",
										"#42f44e"
									],
									'hoverBackgroundColor' => [
										"#fb954f",
										"#36A2EB",
										"#FF6384",
										"#FFCE56",
										"#42f44e"
									]
								]
							]
						]
					]);
					?>				
				</div>
				<div class='col-md-4'>
				<table class="table table-hover">
							<tr>
							  <th>TNI AU</th>
							  <th>TNI AL</th>
							  <th>TNI AD</th>
							  <th>PNS</th>
							  <th>UMUM</th>
							 
							</tr>
							
							<tr>
							<td><?= $au?> orang</td>
							<td><?= $al ?> orang</td>
							<td><?= $ad ?> orang</td>
							<td><?= $pns ?> orang</td>
							<td><?= $umum ?> orang</td>
							</tr>
							
							

						  </table>
				</div>
			  </div>
 
    
				 
              </div>
			 
			  <div class="tab-pane" id="tab_5-2">
			  <div class='row'>
				<div class='col-md-8'>
				<?= ChartJs::widget([
					'type' => 'pie',
					
					'data' => [
						'labels' => ["Pasien Baru= ".$baru." orang", "Pasien Lama = ".$lama." orang"],
						'datasets' => [
							[
								
								'data' => [$baru,$lama],
								'backgroundColor' => [
									"#fb954f",
									"#36A2EB",
									"#FF6384",
									"#FFCE56",
									"#42f44e"
								],
								'hoverBackgroundColor' => [
									"#fb954f",
									"#36A2EB",
									"#FF6384",
									"#FFCE56",
									"#42f44e"
								]
							]
						]
					]
				]);
				?>
				</div>
				<div class='col-md-4'>
				<table class="table table-hover">
							<tr>
							  <th>Baru</th>
							  <th>Lama</th>
							 
							</tr>
							
							<tr>
							<td><?= $baru?> orang</td>
							<td><?= $lama ?> orang</td>
							
							</tr>
							
							

						  </table>
				</div>
			  </div>

			  </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
		 
          <!-- nav-tabs-custom -->
		  
        </div>
        </div>
        </div>
			
