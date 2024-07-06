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
				<div class="row">
					<div class="col-sm-5">
						<div class="input-group">
						  <input type="text" class="form-control" id="input-barang" placeholder="Cari Pasien...">
						  <span class="input-group-btn">
							<button id="search-barang" class="btn btn-warning" type="button"><i class='fa fa-search'></i></button>
						  </span>
						</div><!-- /input-group -->
					</div>
				</div>
			</div>
			<div class="box-body table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>No Rekmed</th>
							<th>Nama Pasien</th>
							<th>Usia</th>
							<th>Jenis Kelamin</th>
							
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php

						if($dataTemplate){
						//echo $dataBarang; 
							$noBar = 0;
							foreach($dataTemplate as $data){
							$noBar++;
							
						?>
						<tr>
							<td><?= $noBar ?><input type="hidden" name="idtem_input" id="idtem_input_<?= $data->no_rekmed ?>" value="<?= $data->no_rekmed ?>"></td>
							<td><?= $data->no_rekmed ?></td>
							<td><?= $data->pasien->nama_pasien ?></td>
							<td><?= $data->usia ?></td>
							<td><?= $data->pasien->jenis_kelamin ?></td>
						
				
							<td><?= Html::a('<span class="fa fa-plus"></span> Pilih', '#', array('id'=>'idtemd_'. $data->no_rekmed, 'class'=>'btn btn-default' )); ?></td>


						<?php
						
$this->registerJs("

	$('body').on('click', '#idtemd_{$data->no_rekmed}', function(e){
		getTemplatemd($('#idtem_input_{$data->no_rekmed }').val());
		$('#mdTemplate').modal('hide');
	});
	$('#search-barang').on('click',function(){
		barang = $('#input-barang').val();
		getSearchBarang(barang);
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
$urlDataBarangmd = Url::to(['suratsakit/get-data-pasien']);
$urlDataBsSearch = Url::to(['suratsakit/getsb']);

$this->registerJs("



	function getSearchBarang(barang) {
		$.ajax({
			url: '{$urlDataBsSearch}?no_rekmed='+barang,
			type: 'GET',
			success: function(data){
				$('#tabel-data-barang').html(data);
			}
		});
	}

	function getTemplatemd(id) {
		$.ajax({
			type: 'POST',
			url: '{$urlDataBarangmd}',
			data: {id: id},
			dataType: 'json',
			success: function (data) {
				if(data !== null){
					var res = JSON.parse(JSON.stringify(data));
					$('#suratsakit-no_rekmed').val(res.no_rekmed);
					$('#suratsakit-nama').val(res.nama_pasien);
					$('#suratsakit-usia').val(res.usia);
					$('#suratsakit-jk').val(res.jenis_kelamin);
					
					
					//$('#transaksidetail-harga-disp').val(format_money(parseInt(harga),''));
					// console.log(kode +' '+ idstok);
				}
			},
			error: function (exception) {
				alert(exception);
			}
		});
	}
	
	function format_money(n, currency) {
		return currency + ' ' + n.toFixed(2).replace(/./g, function(c, i, a) {
			return i > 0 && c !== '.' && (a.length - i) % 3 === 0 ? ',' + c : c;
		});
	}
	
", View::POS_READY);
?>