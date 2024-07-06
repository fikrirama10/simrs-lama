<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\web\View;
use kartik\grid\GridView;
use dosamigos\chartjs\ChartJs;
use kartik\date\DatePicker;

$this->title = 'Daftar Transaksi Farmasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-index" style='margin-top:20px;'>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<div class="box">
		<div class="box-header">
			<h3>Data Pendapatan Farmasi</h3>
			
			<div class="row">
			<?php
			$start = (isset($_GET['start']))? $_GET['start'] : date('Y-m-d');
			$end = (isset($_GET['end']))? $_GET['end'] : date('Y-m-d');
			$cek = (isset($_GET['cek']))? $_GET['cek'] : 'today';
			?>
			
				<div class="col-sm-5">
					<div class="row">
						<div class="col-sm-6">
							<label>Start Date</label>
							<?= DatePicker::widget([
							'id' => 'start_date',
							'name' => 'start_date',
							'value' => $start,
							'options' => ['placeholder' => 'Select issue date ...'],
							'removeButton' => false,
							'pluginOptions' => [
								'format' => 'yyyy-mm-dd',
								'todayHighlight' => true
							]
							]); ?>
						</div>
						<div class="col-sm-6">
							<label>End Date</label>
							<?= DatePicker::widget([
							'id' => 'end_date',
							'name' => 'end_date',
							'value' => $end,
							'options' => ['placeholder' => 'Select issue date ...'],
							'removeButton' => false,
							'pluginOptions' => [
								'format' => 'yyyy-mm-dd',
								'todayHighlight' => true
							]
							]); ?>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
				
				<div class='col-md-4'  style='margin-top:22px;'><span class="input-group-btn">
							  <button type="button" class="btn btn-info btn-flat" id='btn-search'><i class='fa fa-search'></i></button>
				</span>	</div>
				
					
				</div>
				
				<div class="col-sm-3">
					
					<a href="report?start=<?= $start ?>&end=<?= $end ?>&cek=<?= $cek ?>" target="blank" id="print_pdf" class="btn btn-danger" style='margin-top:22px;'><i class="fa fa-print" style="width:20px"></i>Print Pdf</a>
				</div>
			</div>
		</div>
		
			
	</div>
</div>
<div class='box box-body'>
	<div id='ajax_gridview'>

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
						<th>Jenis Pendapatan</th>
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
	</div>
<?php
$urlDataSearch = Url::to(['statistik/get-income-farmasi']);
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
			$('#print_pdf').attr('href', 'report?start='+start+'&end='+end+'&cek='+radio);
			$('#start_date').attr('disabled', true);
			$('#end_date').attr('disabled', true);
		} else if(radio == 'this_month') {
			start = 1+'-'+nama_bulan[month]+'-'+year;
			end = lastday.toLocaleFormat('%d-%b-%Y');
			
			$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek='+radio);
			$('#print_pdf').attr('href', 'report?start='+start+'&end='+end+'&cek='+radio);
			$('#start_date').attr('disabled', true);
			$('#end_date').attr('disabled', true);
		} else if(radio == 'this_year') {
			start = 1+'-'+nama_bulan[0]+'-'+year;
			end = lastdayinyear.toLocaleFormat('%d-%b-%Y');
			
			$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek='+radio);
			$('#print_pdf').attr('href', 'report?start='+start+'&end='+end+'&cek='+radio);
			$('#start_date').attr('disabled', true);
			$('#end_date').attr('disabled', true);
		} else if(radio == 'custom') {
			start = $('#start_date').val();
			end = $('#end_date').val();
			
			$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek=custom');
			$('#print_pdf').attr('href', 'report?start='+start+'&end='+end+'&cek=custom');
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
		$('#print_pdf').attr('href', 'report?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
	});

	/*ini untuk mengeset end date ke button cek*/
	$('#end_date').on('change',function(){
		end = $(this).val();
		start = $('#start_date').val();
		getSearch(start,end);
		$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
		$('#print_pdf').attr('href', 'report?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
	});

	$('#btn-search').on('click', function(){
		end = $('#end_date').val();
		start = $('#start_date').val();
		getSearch(start,end);
		$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
		$('#print_pdf').attr('href', 'report?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
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
