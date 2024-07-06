<?php
	use yii\helpers\Url;
	use kartik\date\DatePicker;
	use yii\widgets\Pjax;
	use yii\web\View;
	$no=1;
?>
<?php
	$start = (isset($_GET['start']))? $_GET['start'] : date('Y-m-d');
			$end = (isset($_GET['end']))? $_GET['end'] : date('Y-m-d');
			$cek = (isset($_GET['cek']))? $_GET['cek'] : 'today';
	?>
	<div class='box'>
	<div class='box-header'>
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
				
				<div class='col-md-4'  style='margin-top:22px;'>	<span class="input-group-btn">
							  <button type="button" class="btn btn-info btn-flat" id='btn-search'><i class='fa fa-search'></i></button>
				</span>	</div>
				<div class='col-md-3'> 
					<a href="laporan-kg?start=<?= $start ?>&end=<?= $end ?>&cek=<?= $cek ?>" target="_blank" id="print_pdf" class="btn btn-danger" style='margin-top:22px;'><i class="fa fa-print" style="width:20px"></i>Print Pdf</a>  	  
				</div> 
					
				</div>
				
	</div>
</div>

<div class='box box-body'>
<div id='ajax_gridview'>
<table class='table table-bordered' style='text-align:center;'>
	<tr >
		<th align=center rowspan="2">Pengunjung / Kunjungan</th>
		
		<th colspan="3">TNI AU</th>
		<th colspan="3">TNI AD</th>
		<th colspan="3">TNI AL</th>
		<th colspan="3">POLRI</th>
		<th align=center rowspan="2">BPJS </th>
		<th align=center rowspan="2">Yanmas</th>
		<th align=center rowspan="2">Jumlah</th>
	</tr>
	<tr>
		<!-- TNI AU -->
		<th scope="col">Mil</th>
		<th scope="col">Sip</th>
		<th scope="col">Kel</th>
		<!-- TNI AD -->
		<th scope="col">Mil</th>
		<th scope="col">Sip</th>
		<th scope="col">Kel</th>
		<!-- TNI AL -->
		<th scope="col">Mil</th>
		<th scope="col">Sip</th>
		<th scope="col">Kel</th>
		<!-- polri -->
		<th scope="col">Mil</th>
		<th scope="col">Sip</th>
		<th scope="col">Kel</th>
		
	</tr>
		<tr >
		<th align=center rowspan="2">1</th>
		
		
		
	</tr>
	<tr>
		<!-- TNI AU -->
		<th scope="col">2</th>
		<th scope="col">3</th>
		<th scope="col">4</th>
		<!-- TNI AD -->
		<th scope="col">5</th>
		<th scope="col">6</th>
		<th scope="col">7</th>
		<!-- TNI AL -->
		<th scope="col">8</th>
		<th scope="col">9</th>
		<th scope="col">10</th>
		<!-- polri -->
		<th scope="col">11</th>
		<th scope="col">12</th>
		<th scope="col">13</th>
		<th scope="col">14</th>
		<th scope="col">15</th>
		<th scope="col">16</th>
		
	</tr>
	
	
	<tr>
	<th id="navi" scope="row">Kunjungan Baru</th>
		<!-- TNI AU -->
	<td headers="team navi win score"><?= $json['tniau']['Mil']['PengunjungMilBaru'] ?></td>			
	<td headers="team navi lost score"><?= $json['tniau']['Sip']['PengunjungSipBaru'] ?></td>
	<td headers="team navi draw score"><?= $json['tniau']['Kel']['PengunjungKelBaru'] ?></td>
	<!-- TNI AD -->
	<td headers="team navi win score">0</td>
	<td headers="team navi draw score">0</td>
	<td headers="team navi lost score">0</td>
	<!-- TNI AL -->
	<td headers="team navi win score">0</td>
	<td headers="team navi draw score">0</td>
	<td headers="team navi lost score">0</td>
	<!-- POLRI -->
	<td headers="team navi win score">0</td>
	<td headers="team navi draw score">0</td>
	<td headers="team navi lost score">0</td>
	<!-- PUR -->
	<td headers="team navi win score"><?= $json['Bpjs']['BpjsBaru'] ?></td>
	<td headers="team navi win score"><?= $json['Yanmas']['YanmasBaru'] ?></td>
	<td headers="team navi win score"><?= $json['Jumlah']['JumlahBaru'] ?></td>
	</tr>
	<tr>
	<th id="navi" scope="row">Kunjungan Ulang</th>
		<!-- TNI AU -->
		<!-- TNI AU -->
	<td headers="team navi win score"><?= $json['tniau']['Mil']['PengunjungMilLama'] ?></td>			
	<td headers="team navi lost score"><?= $json['tniau']['Sip']['PengunjungSipLama'] ?></td>
	<td headers="team navi draw score"><?= $json['tniau']['Kel']['PengunjungKelLama'] ?></td>
	<!-- TNI AD -->
	<td headers="team navi win score">0</td>
	<td headers="team navi draw score">0</td>
	<td headers="team navi lost score">0</td>
	<!-- TNI AL -->
	<td headers="team navi win score">0</td>
	<td headers="team navi draw score">0</td>
	<td headers="team navi lost score">0</td>
	<!-- POLRI -->
	<td headers="team navi win score">0</td>
	<td headers="team navi draw score">0</td>
	<td headers="team navi lost score">0</td>
	<!-- PUR -->
	<td headers="team navi win score"><?= $json['Bpjs']['BpjsLama'] ?></td>
	<td headers="team navi win score"><?= $json['Yanmas']['YanmasLama'] ?></td>
	<td headers="team navi win score"><?= $json['Jumlah']['JumlahLama'] ?></td>
	</tr>
	<tr>
	<th id="navi" scope="row">Jumlah</th>
	<!-- TNI AU -->
	<td headers="team navi win score"><?= $json['tniau']['Mil']['PengunjungMilSemua'] ?></td>			
	<td headers="team navi lost score"><?= $json['tniau']['Sip']['PengunjungSipSemua'] ?></td>
	<td headers="team navi draw score"><?= $json['tniau']['Kel']['PengunjungKelSemua'] ?></td>
	<!-- TNI AD -->
	<td headers="team navi win score">0</td>
	<td headers="team navi draw score">0</td>
	<td headers="team navi lost score">0</td>
	<!-- TNI AL -->
	<td headers="team navi win score">0</td>
	<td headers="team navi draw score">0</td>
	<td headers="team navi lost score">0</td>
	<!-- POLRI -->
	<td headers="team navi win score">0</td>
	<td headers="team navi draw score">0</td>
	<td headers="team navi lost score">0</td>
	<!-- PUR -->
	<td headers="team navi win score"><?= $json['Bpjs']['BpjsSemua'] ?></td>
	<td headers="team navi win score"><?= $json['Yanmas']['YanmasSemua'] ?></td>
	<td headers="team navi win score"><?= $json['Jumlah']['JumlahSemua'] ?></td>
	
	</tr>
	
</table>
</div>
</div>
<?php
$urlDataSearch = Url::to(['sistem-informasi/get-kunjungan-gigi']);
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
		$('#print_pdf').attr('href', 'laporan-kg?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
	});

	/*ini untuk mengeset end date ke button cek*/
	$('#end_date').on('change',function(){
		end = $(this).val();
		start = $('#start_date').val();
		getSearch(start,end);
		$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
		$('#print_pdf').attr('href', 'laporan-kg?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
	});

	$('#btn-search').on('click', function(){
		end = $('#end_date').val();
		start = $('#start_date').val();
		getSearch(start,end);
		$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
		$('#print_pdf').attr('href', 'laporan-kg?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
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
