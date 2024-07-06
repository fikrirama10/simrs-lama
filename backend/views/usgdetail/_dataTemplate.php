<?php
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;

use yii\helpers\StringHelper;
use yii\grid\GridView;
?>
	<div id="tabel-data-barang">
		<div class="row">
			<div class="col-sm-12">
				
			</diV>
		</div>
		<div class="box">
			<div class="box-header">
				
			</div>
			<div class="box-body table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Judul</th>
							<th>Hasil</th>
							<th>Kesan/Kesimpulan</th>
							
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
							<td><?= $noBar ?><input type="hidden" name="idtem_input" id="idtem_input_<?= $data->id ?>" value="<?= $data->id ?>"></td>
							<td><?= $data->judul ?></td>
							<td><?= StringHelper::truncateWords($data->hasil, 10, $suffix = '......', $asHtml = false ) ?></td>
							<td><?= StringHelper::truncateWords($data->kesimpulan, 10, $suffix = '......', $asHtml = false ) ?></td>
				
							<td><?= Html::a('<span class="fa fa-plus"></span> Pilih', '#', array('id'=>'idtemd_'. $data->id, 'class'=>'btn btn-default' )); ?></td>


						<?php
$this->registerJs("

	$('body').on('click', '#idtemd_{$data->id}', function(e){
		getTemplatemd($('#idtem_input_{$data->id }').val());
		$('#mdCustomer').modal('hide');
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
$urlDataBarangmd = Url::to(['usgdetail/get-data-template']);
$urlDataBsSearch = Url::to(['transaksi/get-data-bs-search']);

$this->registerJs("

	$('#search-barang').on('click',function(){
	
		brg = $('#input-barang').val();
		kb = 0;
		getSearchBs(brg,kb);
	});

	function getSearchBs(brg,kb) {
		$.ajax({
			url: '{$urlDataBsSearch}?barang='+brg+'&kategori='+kb,
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
					$('#usgdetail-judul').val(res.judul);
					$('#usgdetail-hasil').val(stripHtml(res.hasil));
					$('#usgdetail-kesimpulan').val(stripHtml(res.kesimpulan));
					
					
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
	function stripHtml(html)
{
   var tmp = document.createElement('DIV');
   tmp.innerHTML = html;
   return tmp.textContent || tmp.innerText || '';
}
	
", View::POS_READY);
?>