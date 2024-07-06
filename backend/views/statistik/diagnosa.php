<?php 

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\chartjs\ChartJs;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\widgets\Pjax;
use yii\web\View;
$no=1;

		$jumlah = array();
		$diagnosa = array();
		foreach($json2 as $tr){
			array_push($jumlah,$tr['Jumlah']);
			array_push($diagnosa,$tr['Diagnosa']);
		}
 ?>
 <?php
			$start = (isset($_GET['start']))? $_GET['start'] : date('m');
			$end = (isset($_GET['end']))? $_GET['end'] : date('Y');
			$cek = (isset($_GET['cek']))? $_GET['cek'] : 'today';
			?>
 <div class='box box-body'>
 	<div class='row'>
					<div class="col-sm-8">
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
							<select class="form-control" name="Bulan" id="end_date">
							  <option value="2019">2019</option>
							  <option value="2020">2020</option>
							  <option value="2021">2021</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
				
				<div class='col-md-1'  style='margin-top:22px;'><span class="input-group-btn">
							  <button type="button" class="btn btn-info btn-flat" id='btn-search'><i class='fa fa-search'></i></button>
				</span>	</div>
				
					
				</div>
				
	</div>

	<hr>
 <div id='ajax_gridview'>
 <div class='row'>
 <div class='col-md-6'>
<?= ChartJs::widget([
    'type' => 'bar',
    'options' => [
        'height' => 400,
        'width' => 400
    ],
    'data' => [
        'labels' => $diagnosa,
        'datasets' => [
            [
                'label' => "10 Penyakit Terbanyak",
                'backgroundColor' => "rgba(0,137,233,0.2)",
                'borderColor' => "rgba(0,137,233,1)",
                'pointBackgroundColor' => "rgba(0,137,233,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(0,137,233,1)",
                'data' => $jumlah,
            ],
            
        ]
    ]
]);
?>
</div>
<div class='col-md-6'>

	<hr>
	<table class='table table-bordered'>
		<tr>
			<th>No</th>
			<th>Diagnosa</th>
			<th>Jumlah</th>
		</tr>
		<?php foreach($json2 as $tr){?>
		<tr>
			<td><?= $no++?></td>
			<td><?= $tr['Nama']?></td>
			<td><?= $tr['Jumlah']?></td>
		</tr>
		<?php } ?>
	</table>
	</div>
	</div>
	</div>
	</div>

<?php
$urlDataSearch = Url::to(['statistik/get-search']);
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
