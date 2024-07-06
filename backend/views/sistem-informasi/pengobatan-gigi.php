<?php
	use yii\helpers\Url;
	use kartik\date\DatePicker;
	use yii\widgets\Pjax;
	use yii\web\View;
	use common\models\KategoriTindakan;
	$kattindakan = KategoriTindakan::find()->all();
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
					<a href="laporan-pg?start=<?= $start ?>&end=<?= $end ?>&cek=<?= $cek ?>" target="blank" id="print_pdf" class="btn btn-danger" style='margin-top:22px;'><i class="fa fa-print" style="width:20px"></i>Print Pdf</a> 
				</div> 
					
				</div>
				
	</div>
</div>

	<div class='box box-body'>
	<div class='row'>
	<div class='col-md-6'>
	<table class='table table-bordered'>
		<tr >
					<th align=center colspan="3">Pengobatan Gigi </th>
					
		</tr>
		<tr >
					<th align=center>No</th>
					<th align=center >Golongan</th>
					<th align=center>Macam Pengobatan</th>  
					
		</tr>
		<?php foreach($kattindakan as $kt): 
			$url = 'https://simrs.rsausulaiman.com/dashboard/rest/pengobatan-gigi?kat='.$kt->id;
			$content = file_get_contents($url);
			$json = json_decode($content, true);
			
		?>
		<tr>
			<td rowspan="<?= count($json)+1 ?>"><?= $no++ ?></td>
			<td rowspan="<?= count($json)+1 ?>"> <?= $kt->kategori ?> </td> 			
		</tr>
		<?php  for($a=0; $a < count($json); $a++){ ?>
		<tr>				
			<td><?= $json[$a]['Nama'] ?></td>	 	 
		</tr>
		<?php } ?>
		
		<?php endforeach; ?>
		
	</table>
	
	</div>
	
	<div class='col-md-6'>	
	<div id='ajax_gridview'>
		<table class='table table-bordered'>
				<tr>  
					<th colspan="3">TNI AU</th>
					<th colspan="3">TNI AD</th>
					<th colspan="3">TNI AL</th>
					<th align=center rowspan="2">BPJS </th>
					<th align=center rowspan="2">Yanmas</th>
					<th align=center rowspan="2">Jumlah</th>
				</tr>
				<tr>
					<!-- TNI AU -->
					<th scope="col">M</th>
					<th scope="col">S</th>
					<th scope="col">K</th>
					<!-- TNI AD -->
					<th scope="col">M</th>
					<th scope="col">S</th>
					<th scope="col">K</th>
					<!-- TNI AL -->
					<th scope="col">M</th>
					<th scope="col">S</th>
					<th scope="col">K</th>
					
				</tr>
				
				<?php  for($a=0; $a < count($json2); $a++){ ?>
						<tr>			
							<td><?= $json2[$a]['TniauMil'] ?></td>
							<td><?= $json2[$a]['TniauSip'] ?></td>
							<td><?= $json2[$a]['TniauKel'] ?></td>
							
							<td>0</td>
							<td>0</td>
							<td>0</td>
							
							<td>0</td>
							<td>0</td>
							<td>0</td>
							
							<td><?= $json2[$a]['Bpjs'] ?></td>
							<td><?= $json2[$a]['Yanmas'] ?></td>
							<td><?= $json2[$a]['Jumlah'] ?></td>		
						</tr>
				<?php } ?>
		</table>
	</div>
	</div> 
	</div> 
	</div> 
<?php
$urlDataSearch = Url::to(['sistem-informasi/get-pengobatan-gigi']);
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
		$('#print_pdf').attr('href', 'laporan-pg?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
	});

	/*ini untuk mengeset end date ke button cek*/
	$('#end_date').on('change',function(){
		end = $(this).val();
		start = $('#start_date').val();
		getSearch(start,end);
		$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
		$('#print_pdf').attr('href', 'laporan-pg?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
	});

	$('#btn-search').on('click', function(){
		end = $('#end_date').val();
		start = $('#start_date').val();
		getSearch(start,end);
		$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
		$('#print_pdf').attr('href', 'laporan-pg?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
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
