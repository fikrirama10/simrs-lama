	<?php
use yii\helpers\Url;
?>
			<div class='row'>
				<div class="col-lg-12 col-xs-12">
							<div class="small-box" style='background:#222d32;'>
								<div class="inner">
								 <h3 style="color:#fff;" class='text-center'>Rp. <?= Yii::$app->algo->IndoCurr($json['kasirBpjs']['income'] + $json['kasirBpjs']['incomresep'])?></h3>	
								 <p style="color:#fff;" class='text-center'>Pemasukan Pasien BPJS</p>
								</div>	
								<div class="icon ">
								  <i class="fa fa-money"></i>
								</div>		
								<a  class="small-box-footer">
								 
								</a> 
							</div>
						</div>
				<div class="col-md-4">
                  <p class="text-center">
                    <strong>Detail Transaksi</strong>
                  </p>

                  <div class="progress-group">
                     <span class="progress-text"><a href='<?= Url::to(['transaksi/rajal']) ?>'>Rawat Jalan</a></span>
                    <span class="progress-number"><b><?= $json['kasirBpjs']['rajal'] ?></b>/ Rp.<?= Yii::$app->algo->IndoCurr($json['kasirBpjs']['rajalincome'])?></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                   <span class="progress-text"><a href='<?= Url::to(['transaksi/ugd']) ?>'>UGD</a></span>
                    <span class="progress-number"><b><?= $json['kasirBpjs']['igd'] ?></b> / Rp.<?= Yii::$app->algo->IndoCurr($json['kasirBpjs']['ugdincome'])?></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                     <span class="progress-text"><a href='<?= Url::to(['transaksi/ranap']) ?>'>Rawat Inap</a></span>
                    <span class="progress-number"><b><?= $json['kasirBpjs']['ranap'] ?></b> / Rp.<?= Yii::$app->algo->IndoCurr($json['kasirBpjs']['ranapincome'])?></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                    </div>
                  </div>
				   <div class="progress-group">
                    <span class="progress-text"><a href ='<?= Url::to(['statistik/pendapatan-farmasi']) ?>'>Obat Obatan</a></span>
                    <span class="progress-number"><b> Rp.<?= Yii::$app->algo->IndoCurr($json['kasirBpjs']['incomresep'])?></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                    </div>
                  </div>
				  
                  <!-- /.progress-group -->
                 
                  <!-- /.progress-group -->
                </div>
			</div>