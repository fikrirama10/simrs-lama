<?php
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
?>
	<div id="tabel-data-barang">
		<div class="row">
			<div class="col-sm-12">
				
			</diV>
		</div>
		<div class="box">
			<div class="box-header">
			
			<div class="box-body table-responsive">
			<h4>Pasien Yanmasum</h4>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>No Rekmed</th>
							<th>No Rawat</th>
							<th>Nama Pasien</th>
							<th>Jenis Rawat</th>
							
							<th>#</th>
						</tr>
					</thead>
					<tbody>
						<?php

						if($dataYanmas){
						//echo $dataBarang; 
							$noBar = 0;
							foreach($dataYanmas as $data){
							$noBar++;
							
						?>
						<tr>
							<td><?= $noBar ?><input type="hidden" name="idtem_input" id="idtem_input_<?= $data->id ?>" value="<?= $data->id ?>"></td>
							<td><?= $data->no_rekmed ?></td>
							<td><?= $data->idrawat ?></td>
							<td><?= $data->pasien->nama_pasien ?></td>
							<td><?= $data->jerawat->jenisrawat?></td>					
				
							<td><?= Html::a('<span class="fa fa-plus"></span> Pilih', '#', array('id'=>'idtemd_'.$data->id, 'class'=>'btn btn-default' )); ?></td>

							<?php
												
							$this->registerJs("

								$('body').on('click', '#idtemd_{$data->id}', function(e){
									getTemplatemd($('#idtem_input_{$data->id }').val());
									$('#mdYanmasum').modal('hide');
								});
															
								
							", View::POS_READY);
							?>
					</tr>
						<?php 
							}
							
						}else{
						?>
						<tr>
							<td colspan=8><div class="empty">No result found.</div></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<h4>Pasien BPJS</h4>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>No Rekmed</th>
							<th>No Rawat</th>
							<th>Nama Pasien</th>
							<th>Jenis Rawat</th>
							
							<th>#</th>
						</tr>
					</thead>
					<tbody>
						<?php

						if($dataBpjs){
						//echo $dataBarang; 
							$noBar = 0;
							foreach($dataBpjs as $data){
							$noBar++;
							
						?>
						<?php if($data->batal == 1){echo '<tr class="bg-danger">';}else{ ?>
						<tr>
						    <?php } ?>
							<td><?= $noBar ?><input type="hidden" name="idtem_input" id="idtem_input_<?= $data->id ?>" value="<?= $data->id ?>"></td>
							<td><?= $data->no_rekmed ?></td>
							<td><?= $data->idrawat ?></td>
							<td><?= $data->pasien->nama_pasien ?></td>
							<td><?= $data->jerawat->jenisrawat?></td>					
				            <?php if($data->batal < 1){ ?>
							<td><?= Html::a('<span class="fa fa-plus"></span> Pilih', '#', array('id'=>'idtemd_'.$data->id, 'class'=>'btn btn-default' )); ?></td>
                            <?php } ?>
							<?php
												
							$this->registerJs("

								$('body').on('click', '#idtemd_{$data->id}', function(e){
									getTemplatemd($('#idtem_input_{$data->id }').val());
									$('#mdYanmasum').modal('hide');
								});
															
								
							", View::POS_READY);
							?>
					</tr>
						<?php 
							}
							
						}else{
						?>
						<tr>
							<td colspan=8><div class="empty">No result found.</div></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
<?php
$urlDataBarangmd = Url::to(['billing/getrajal']);

$this->registerJs("


	function getTemplatemd(id) {
		$.ajax({
			type: 'POST',
			url: '{$urlDataBarangmd}',
			data: {id: id},
			dataType: 'json',
			success: function (data) {
				if(data !== null){
					var res = JSON.parse(JSON.stringify(data));
					$('#pasien-nobpjs').val(res.no_rekmed);
					
					
					
					//$('#transaksidetail-harga-disp').val(format_money(parseInt(harga),''));
					// console.log(kode +' '+ idstok);
				}
			},
			error: function (exception) {
				alert(exception);
			}
		});
	}
	
", View::POS_READY);
?>