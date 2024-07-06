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
							$noBar2 = 0;
							foreach($dataBpjs as $datas){
							$noBar2++;
							
						?>
						<tr>
							<td><?= $noBar2 ?><input type="hidden" name="idtemm_input" id="idtemm_input_<?= $datas->id ?>" value="<?= $datas->id ?>"></td>
							<td><?= $datas->no_rekmed ?></td>
							<td><?= $datas->idrawat ?></td>
							<td><?= $datas->pasien->nama_pasien ?></td>
							<td><?= $datas->jerawat->jenisrawat?></td>					
				
							<td><?= Html::a('<span class="fa fa-plus"></span> Pilih', '#', array('id'=>'idtemds_'.$datas->id, 'class'=>'btn btn-default' )); ?></td>

							<?php
												
							$this->registerJs("

								$('body').on('click', '#idtemds_{$datas->id}', function(e){
									getBpjs($('#idtemm_input_{$datas->id }').val());
									$('#mdBpjs').modal('hide');
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
$urlDataBarang2 = Url::to(['billing/getrajal']);

$this->registerJs("


	function getBpjs(id) {
		$.ajax({
			type: 'POST',
			url: '{$urlDataBarang2}',
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