<?php 
use yii\helpers\Url;

$url2 = 'https://simrs.rsausulaiman.com/apites/kasir-yanmas-day';
        $content2 = file_get_contents($url2);
        $json2 = json_decode($content2, true);
 ?>
	<div class="row">
        <div class="col-md-12">
          <div class="box">
           
            
            <div class="box-footer">
			 <h3>Transaksi Hari Ini</h3> <hr>
				<div class='row'>
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
					  <div class="small-box bg-purple">
						<div class="inner">
						  <h3><?= $json2['response']['kasirYanmas']['trx'] ?></h3>
						  <p>Pasien Yanmas </p>
						</div>
						<div class="icon">
						  <i class="fa fa-users"></i>
						</div>
						<a href="<?= Url::to(['/trxmanual'])?>"  class="small-box-footer">
						  More info <i class="fa fa-arrow-circle-right"></i>
						</a> 
					  </div> 
					</div>
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
					  <div class="small-box bg-green">
						<div class="inner">
						  <h3><?= $json2['response']['kasirBpjs']['trx'] ?></h3>
						  <p>Pasien BPJS</p>
						</div>
						<div class="icon ">
						  <i class="fa fa-users"></i>
						</div>
						<a  class="small-box-footer">
						  More info <i class="fa fa-arrow-circle-right"></i>
						</a> 
					  </div> 
					</div>
					
				</div>
				<hr>
				 <h3 class='text-center'><b>INCOME</b></h3> <hr>
				<div class='row'>
					<div class="col-lg-6 col-xs-6">
						<div class="small-box" style='background:#b7b7b7;'>
							<div class="inner">
							 <h3 style="color:#fff;" class='text-center'>Rp. <?= Yii::$app->algo->IndoCurr($json2['response']['kasirYanmas']['income'])?></h3>	
							 <p style="color:#fff;" class='text-center'>Pemasukan Pasien Yanmas</p>
							</div>	
							<div class="icon ">
							  <i class="fa fa-money"></i>
							</div>		
							<a  class="small-box-footer">
							  More info <i class="fa fa-arrow-circle-right"></i>
							</a> 
						</div>
					</div>
					<div class="col-lg-6 col-xs-6">
						<div class="small-box" style='background:#222d32;'>
							<div class="inner">
							 <h3 style="color:#fff;" class='text-center'>Rp. <?= Yii::$app->algo->IndoCurr($json2['response']['kasirBpjs']['income'])?></h3>	
							 <p style="color:#fff;" class='text-center'>Pemasukan Pasien BPJS</p>
							</div>	
							<div class="icon ">
							  <i class="fa fa-money"></i>
							</div>
							<a  class="small-box-footer">
							  More info <i class="fa fa-arrow-circle-right"></i>
							</a> 						
						</div>
					</div>
				</div>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>