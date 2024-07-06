<?php 
use common\models\Obat;
use common\models\ApotekStokopname;	
use common\models\Kartustok;	
use yii\helpers\Html;
use dosamigos\chartjs\ChartJs;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\widgets\Pjax;
use yii\web\View;
use common\models\Jenisbayar;
 $bayar = Jenisbayar::find()->where(['between','id',4,5])->all();
$no1 = 1;
?>
<?php
			$start = (isset($_GET['start']))? $_GET['start'] : date('m');
			$end = (isset($_GET['end']))? $_GET['end'] : date('Y');
			$cek = (isset($_GET['cek']))? $_GET['cek'] : 'today';
			?>
<div class='row'>
					<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-6">						
							<label>Bulan</label>
							<select class="form-control" name="Bulan" id="start_date">
							  <option value="1">Januari</option>
							  <option value="2">Februari</option>
							  <option value="3">Maret</option>
							  <option value="4">April</option>
							  <option value="5">Mei</option>
							  <option value="6">Juni</option>
							  <option value="7">Juli</option>
							  <option value="8">Agustus</option>
							  <option value="9">September</option>
							  <option value="10">Oktober</option>
							  <option value="11">November</option>
							  <option value="12">Desember</option>
							</select>
						</div>
						<div class="col-sm-6">
							<label>Tahun</label>
							<?php
							$now=date('Y');
							echo "<select class='form-control' name='tahun' id='end_date'>";
							for ($a=2019;$a<=$now;$a++)
							{
								 echo "<option  value='$a'>$a</option>";
							}
							echo "</select>";
							?>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
				<div class='col-md-8'  style='margin-top:22px;'>
				<select  class="form-control" name='textsearch' id='textsearch' form='carform'>
									<option value=''>Pilih Jenis Obat</option>
									<?php foreach($bayar as $b ): ?>
									<option value="<?= $b->id ?>"><?= $b->jenisbayar ?></option>
									<?php endforeach; ?>
						</select>
				</div>
				<div class='col-md-1'  style='margin-top:22px;'><span class="input-group-btn">
							  <button type="button" class="btn btn-info btn-flat" id='btn-search'><i class='fa fa-search'></i></button>
				</span>	</div>
				
					
				</div>
				<div class="col-sm-3">
					<a href="laporanrawat?start=<?= $start ?>&end=<?= $end ?>&cek=<?= $cek ?>" id="cek" class="btn btn-warning mup25" style="display:none;">Apply Filter</a>
					  <!-- radio -->
					<a href="printlaporan-bulanan?start=<?= $start ?>&end=<?= $end ?>&cek=<?= $cek ?>" target="_blank" id="print_pdf" class="btn btn-danger" style='margin-top:22px;'><i class="fa fa-print" style="width:20px"></i>Print Pdf</a>
				</div>
</div>
<div class='box box-body'>
<h4>Barang Keluar / Masuk Bulanan</h4>
<hr>
<div id='ajax_gridview'>
	<table class='table table-bordered'>
	<tr>
		<td>No</td>
		<td>Nama Obat</td>
		<td>Stok Awal</td>		
		<td>Stok Masuk</td>
		<td>Stok Keluar</td>
		<td>Stok / Sisa</td>
		<td>#</td>
	</tr>
	<?php  for($a=0; $a < count($json); $a++){ ?>
	<tr>
		<td><?= $no1++ ?></td>
		<td><?=  $json[$a]['namaobat']	?></td>
		<td><?=  $json[$a]['awal']	?></td>
		<td><?=  $json[$a]['masuk']	?></td>
		<td><?=  $json[$a]['keluar']	?></td>
		<td><?=  $json[$a]['akhir']	?></td>
		<td></td>
	</tr>
	<?php } ?>
	</table>
</div>
</div>
<hr>
<?php
$urlDataSearch = Url::to(['apotek/get-data-bulanan']);
$this->registerJs("

	$('input[value={$cek}]').attr('checked', true);
	if('{$cek}' == 'custom'){
		$('#start_date').attr('disabled', false);
		$('#end_date').attr('disabled', false);
	}else{
		$('#start_date').attr('disabled', false);
		$('#end_date').attr('disabled', false);
	}
	
	/*ini untuk mengeset end date ke button cek*/
	$('input[name=r2]').on('change',function(){
		var radio = $(this).val();
		var date = new Date();
		var day = date.getDate();
		var month = date.getMonth();
		var year = date.getFullYear();
		var lastday = new Date(year, month + 1, 0);
		var lastdayinyear = new Date(year, 12, 0);
		var nama_bulan= ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
		if(radio == 'today'){
			start = date.toLocaleFormat('%d-%b-%Y');
			end = date.toLocaleFormat('%d-%b-%Y');
			
			$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek='+radio);
			$('#print_pdf').attr('href', 'printlaporan-bulanan?start='+start+'&end='+end+'&cek='+radio);
			$('#start_date').attr('disabled', true);
			$('#end_date').attr('disabled', true);
		} else if(radio == 'this_month') {
			start = 1+'-'+nama_bulan[month]+'-'+year;
			end = lastday.toLocaleFormat('%d-%b-%Y');
			
			$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek='+radio);
			$('#print_pdf').attr('href', 'printlaporan-bulanan?start='+start+'&end='+end+'&cek='+radio);
			$('#start_date').attr('disabled', true);
			$('#end_date').attr('disabled', true);
		} else if(radio == 'this_year') {
			start = 1+'-'+nama_bulan[0]+'-'+year;
			end = lastdayinyear.toLocaleFormat('%d-%b-%Y');
			
			$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek='+radio);
			$('#print_pdf').attr('href', 'printlaporan-bulanan?start='+start+'&end='+end+'&cek='+radio);
			$('#start_date').attr('disabled', true);
			$('#end_date').attr('disabled', true);
		} else if(radio == 'custom') {
			start = $('#start_date').val();
			end = $('#end_date').val();
			
			$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek=custom');
			$('#print_pdf').attr('href', 'printlaporan-bulanan?start='+start+'&end='+end+'&cek=custom');
			$('#start_date').attr('disabled', false);
			$('#end_date').attr('disabled', false);
		}
		
	});
	
	/*ini untuk mengeset start date ke button cek*/
	$('#start_date').on('change',function(){
		start = $(this).val();
		end = $('#end_date').val();
		getSearch(start,end);
		$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
		$('#print_pdf').attr('href', 'printlaporan-bulanan?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
	});

	/*ini untuk mengeset end date ke button cek*/
	$('#end_date').on('change',function(){
		end = $(this).val();
		start = $('#start_date').val();
		getSearch(start,end);
		$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
		$('#print_pdf').attr('href', 'printlaporan-bulanan?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
	});

	$('#btn-search').on('click', function(){
		end = $('#end_date').val();
		start = $('#start_date').val();
		getSearch(start,end);
		$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
		$('#print_pdf').attr('href', 'printlaporan-bulanan?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
	});
	
	function getSearch(start,end) {
		$.ajax({
			url: '{$urlDataSearch}'+'?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val(),
			type: 'GET',
			success: function(data){
				$('#ajax_gridview').html(data);
			}
		});
	}
	
", View::POS_READY);
?>

