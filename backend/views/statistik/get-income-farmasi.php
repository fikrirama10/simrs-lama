
			<div class='row'>
				<div class="col-lg-6 col-xs-6">
							<div class="small-box" style='background:#b7b7b7;'>
								<div class="inner">
								 <h3 style="color:#fff;" class='text-center'>Rp. <?= Yii::$app->algo->IndoCurr($json['NominalUmum'])?></h3>	
								 <p style="color:#fff;" class='text-center'>Pemasukan Pasien Yanmas</p>
								</div>	
								<div class="icon ">
								  <i class="fa fa-money"></i>
								</div>		
								<a  class="small-box-footer">
								 
								</a> 
							</div>
						</div>
				<div class="col-lg-6 col-xs-6">
					<div class="small-box" style='background:GREEN;'>
						<div class="inner">
						 <h3 style="color:#fff;" class='text-center'>Rp. <?= Yii::$app->algo->IndoCurr($json['NominalBpjs'])?></h3>	
						 <p style="color:#fff;" class='text-center'>Pemasukan Pasien BPJS</p>
						</div>	
						<div class="icon ">
						  <i class="fa fa-money"></i>
						</div>		
						<a  class="small-box-footer">
						 
						</a> 
					</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-md-8'>
				<table class='table table-bordered'>
					<tr>
						<th>Pendapatan</th>
						<th>Total Resep</th>
						<th>Total Pendapatan</th>
					</tr>
					<tr>
						<td>Yanmasum</td>
						<td><?= $json['ResepUmum'] ?> R/</td>
						<td>Rp. <?= Yii::$app->algo->IndoCurr($json['NominalUmum'])?></td>
					</tr>
					<tr>
						<td>BPJS</td>
						<td><?= $json['ResepBpjs'] ?> R/</td>
						<td>Rp. <?= Yii::$app->algo->IndoCurr($json['NominalBpjs'])?></td>
					</tr>
				</table>
				</div>
			</div>
		</div>