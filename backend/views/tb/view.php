<?php
use common\models\Rawatjalan;
use yii\helpers\Url;
?>
<div class="rawatjalan-form">
		<div class='container-fluid'>
			<div class='box box-info'>
				<div class='box box-header'>
					<h3>Detail Pasien</h3>
					
				</div>
				<div class='box box-body'>
					<div class='row'>
						<div class='col-xs-8'>
							<a class='nama_pasien'><?= $pasien->sbb ?>. <?= $pasien->nama_pasien ?></a> <a class='jenis_kelamin'>( <?= $pasien->jenis_kelamin ?> )</a> , <a class='jenis_kelamin'>( <?= $pasien->idStatus->status_hub ?> )</a> , 
						</div>
						<div class='col-xs-4 cs'>
							
							
						</div>
						
						<div class='col-md-12 bt10' >
						RM : <a style='padding-right:20px;'><?= $pasien->no_rekmed ?></a>   No bPJS :<a style='padding-right:20px;'> <?= $pasien->nobpjs ?>	</a>
						NIK :<a style='padding-right:20px;'> <?= $pasien->no_identitas ?>	</a>
						</a>   Tanggal Daftar :<a> <?= $pasien->created_at ?>	</a>
						</div>		
					</div>
					<div class='row'>
						<div class='col-md-12 gol_darah'>
							<b style='font-size:15px;'><?= $pasien->tempat_lahir?>, <?= date('d/m/Y',strtotime($pasien->tanggal_lahir)) ?> ( <?= $pasien->usia?> Th )</b><br>
							
							<?= $pasien->alamat ?>,
							<?php if($pasien->idkel == null && $pasien->idkel == null && $pasien->idkel == null){echo "";}else{ ?>
							<?= $pasien->kel->nama ?> , <?= $pasien->kec->nama ?> , <?= $pasien->kab->nama ?>
							<?php } ?>
						</div>
						<div class='col-md-12'>
				  <!-- Custom Tabs (Pulled to the right) -->
				  <div class="nav-tabs-custom">
					<ul class="nav nav-tabs pull-right">
					  <li class="active"><a href="#tab_1-1" data-toggle="tab"><h4><span class="label label-warning">
  Data Berobat
</span></h4> </a></li>

					  <li class="pull-left header"><i class="fa fa-th"></i> </li>
					</ul>
					<div class="tab-content">
					  <div class="tab-pane active" id="tab_1-1">
					 <h4>Data Rawat</h4>
					  <table class="table table-striped">
						<tr>
						  <th>No</th>
						  <th>Kdiagnosa</th>
						  <th>Poli</th>
						  <th>Jenis Bayar</th>
						  <th>Tanggal</th>
						  
						</tr>
						<?php $rajal = Rawatjalan::find()->where(['no_rekmed'=>$pasien->no_rekmed])->andWhere(['diagket'=>'TB+'])->orderby(['tgldaftar'=>SORT_DESC])->all();
						$no=1;
						if(count($rajal) > 0){
						foreach($rajal as $rj):
						?>
						<?php if(date('Y-m-d') == date('Y-m-d',strtotime($rj->tgldaftar))){?>
						<tr class='bg-info'>
						<?php }else{echo'<tr>';}?>
							<td><?= $no++ ?></td>
							<td><?= $rj->kdiagnosa ?></td>
							<td><?php if($rj->idpoli == null){echo'IGD';}else{?>
							<?= $rj->polii->namapoli?>							
							<?php } ?></td>
							<td><?= $rj->carabayar->jenisbayar?></td>
							<td><?= date('d/m/Y',strtotime($rj->tgldaftar))?></td>
							<td><a href='<?= Url::to(['tb/input?id='.$rj->id]) ?>'><span class="badge badge-success">Lihat</span></a></td>
							
						</tr>
						<?php endforeach; ?>
						<?php }else{ ?>
						<tr>
						<td colspan=7><div class="empty">No result found.</div></td>
						</tr>
						<?php } ?>
						

					  </table>
						
					  </div>
					  <!-- /.tab-pane -->
					  
					  <!-- /.tab-pane -->
              
              <!-- /.tab-pane -->
			  		  
            </div>
            <!-- /.tab-content -->
          </div>
		 
          <!-- nav-tabs-custom -->

						</div>
						</div>
						<div class='row'>
						
						<div class='col-md-12'>
						
						</div>
						</div>
					</div>
				</div>
				
		</div>
	</div>