<?php 
use common\models\Obat;
use common\models\ApotekStokopname;	
use common\models\Kartustok;	
use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\helpers\Url;
use yii\web\View;
use dosamigos\chartjs\ChartJs;
use common\models\Jenisbayar;
$bayar = Jenisbayar::find()->where(['between','id',4,5])->all();
$obat = Obat::find()->where(['idjenisobat'=>4])->orderBy(['stok'=>SORT_ASC])->all();
$kartustok = Kartustok::find()->groupBy('idobat')->orderBy(['id'=>SORT_ASC])->all();
$no = 1;
$no1 = 1;
$no2 = 1;
$url = 'https://simrs.rsausulaiman.com/apites/stok?bulan='.date('m').'&bayar=4';
        $content = file_get_contents($url);
        $json = json_decode($content, true);
?>
<div class='box '>
 <div class="box-header">
			<h3>Data Obat Harian</h3>
			
			<div class="row">
			<?php
			$start = (isset($_GET['start']))? $_GET['start'] : date('Y-m-d');
			$end = (isset($_GET['end']))? $_GET['end'] : date('d-M-Y');
			$cek = (isset($_GET['cek']))? $_GET['cek'] : 'today';
			?>
				<div class="col-sm-5">
					<div class="row">
						<div class="col-sm-12">
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
						
					</div>
				</div>
				<div class="col-sm-3">
				<div class='col-md-8'  style='margin-top:22px;'>
				<select  class="form-control" name='textsearch' id='textsearch' form='carform'>
									<option value=''>Pilih Jenis Bayar</option>
									<?php foreach($bayar as $b ): ?>
									<option value="<?= $b->id ?>"><?= $b->jenisbayar ?></option>
									<?php endforeach; ?>
						</select>
				</div>
				<div class='col-md-4'  style='margin-top:22px;'><span class="input-group-btn">
							  <button type="button" class="btn btn-info btn-flat" id='btn-search'><i class='fa fa-search'></i></button>
				</span>	
				</div>
				
					
				</div>
				
				<div class="col-sm-3">
					<a href="laporanrawat?start=<?= $start ?>&end=<?= $end ?>&cek=<?= $cek ?>" id="cek" class="btn btn-warning mup25" style="display:none;">Apply Filter</a>
					  <!-- radio -->
					<a href="printlaporan?start=<?= $start ?>&end=<?= $end ?>&cek=<?= $cek ?>" target="_blank" id="print_pdf" class="btn btn-danger" style='margin-top:22px;'><i class="fa fa-print" style="width:20px"></i>Print Pdf</a>
				</div>
			</div>
		</div>
<div class='box box-body'>
<h4>Barang Keluar / Masuk Harian </h4>


<br>
<hr>
<div id='ajax_gridview'>

<a>Obat </a>
<table class='table table-bordered'>
	<tr>
		<td>No</td>
		<td>IdObat</td>
		<td>Nama Obat</td>
		<td>Stok Awal</td>		
		<td>Stok Masuk</td>
		<td>Stok Keluar</td>
		<td>Stok / Sisa</td>
		<td>#</td>
	</tr>
	<?php foreach($stokyanmas as $sy): ?>
	<tr>
		<td><?=  $no++ ?> </td>
		<td><?=  $sy->idobat ?> </td>
		<td><?=  $sy->obat->namaobat ?> (<?= $sy->obat->jenis->jenisbayar ?>) </td>
		<td><?=  $sy->stokawal ?> </td>
		<td><?=  $sy->stokmasuk ?> </td>
		<td><?=  $sy->stokkeluar ?> </td>
		<td><?=  $sy->stokakhir ?> </td>
		<td><a href='<?= Yii::$app->params['baseUrl'].'/dashboard/apotek/detail-laporan-obat/?id='.$sy->id?>'  class='btn btn-success btn-xs'>Lihat</a></td>
	</tr>
	<?php endforeach; ?>
</table>
</div>
</div>

<?php
$urlDataSearch = Url::to(['apotek/get-laporan-harian-ym']);
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
			$('#print_pdf').attr('href', 'printlaporan?start='+start+'&end='+end+'&cek='+radio);
			$('#start_date').attr('disabled', true);
			$('#end_date').attr('disabled', true);
		} else if(radio == 'this_month') {
			start = 1+'-'+nama_bulan[month]+'-'+year;
			end = lastday.toLocaleFormat('%d-%b-%Y');
			
			$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek='+radio);
			$('#print_pdf').attr('href', 'printlaporan?start='+start+'&end='+end+'&cek='+radio);
			$('#start_date').attr('disabled', true);
			$('#end_date').attr('disabled', true);
		} else if(radio == 'this_year') {
			start = 1+'-'+nama_bulan[0]+'-'+year;
			end = lastdayinyear.toLocaleFormat('%d-%b-%Y');
			
			$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek='+radio);
			$('#print_pdf').attr('href', 'printlaporan?start='+start+'&end='+end+'&cek='+radio);
			$('#start_date').attr('disabled', true);
			$('#end_date').attr('disabled', true);
		} else if(radio == 'custom') {
			start = $('#start_date').val();
			end = $('#end_date').val();
			
			$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek=custom');
			$('#print_pdf').attr('href', 'printlaporan?start='+start+'&end='+end+'&cek=custom');
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
		$('#print_pdf').attr('href', 'printlaporan?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
	});

	/*ini untuk mengeset end date ke button cek*/
	$('#end_date').on('change',function(){
		end = $(this).val();
		start = $('#start_date').val();
		getSearch(start,end);
		$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
		$('#print_pdf').attr('href', 'printlaporan?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
	});

	$('#btn-search').on('click', function(){
		end = $('#end_date').val();
		start = $('#start_date').val();
		getSearch(start,end);
		$('#cek').attr('href', 'laporanrawat?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
		$('#print_pdf').attr('href', 'printlaporan?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
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
