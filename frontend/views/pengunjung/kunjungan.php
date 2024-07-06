<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\web\View;
use dosamigos\chartjs\ChartJs;
use kartik\date\DatePicker;
use common\models\Pasien;
use yii\helpers\Url;
// $yanmas = Pasien::find()->where(['between','idpekerjaan',5,11])->count();
// $yanmasbaru = Pasien::find()->where(['between','idpekerjaan',5,11])->andwhere(['stpasien'=>'Baru'])->count();
// $yanmaslama = Pasien::find()->where(['between','idpekerjaan',5,11])->andwhere(['stpasien'=>'Old'])->count();

$jumlah = Pasien::find()->count();
$jumlahbaru = Pasien::find()->where(['stpasien'=>'Baru'])->count();
$jumlahlama = Pasien::find()->where(['stpasien'=>'Old'])->count();

$pur = Pasien::find()->where(['idpekerjaan'=>13])->count();
$purbaru = Pasien::find()->where(['idpekerjaan'=>13])->andwhere(['stpasien'=>'Baru'])->count();
$purlama = Pasien::find()->where(['idpekerjaan'=>13])->andwhere(['stpasien'=>'Old'])->count();
//TNI AU
// $tniaumilall = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Mil'])->count();
// $tniausipall = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Sip'])->count();
// $tniaukelall = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Kel'])->count();
$tniaumilbaru = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
$tniausipbaru = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Sip'])->andwhere(['stpasien'=>'Baru'])->count();
$tniaukelbaru = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Kel'])->andwhere(['stpasien'=>'Baru'])->count();
$tniaumillama = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Old'])->count();
$tniausiplama = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Sip'])->andwhere(['stpasien'=>'Old'])->count();
$tniaukellama = Pasien::find()->where(['idpekerjaan'=>1])->andwhere(['subid'=>'Kel'])->andwhere(['stpasien'=>'Old'])->count();
//TNI AD
$tniadmilall = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Mil'])->count();
$tniadsipall = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Sip'])->count();
$tniadkelall = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Kel'])->count();
$tniadmilbaru = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
$tniadsipbaru = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Sip'])->andwhere(['stpasien'=>'Baru'])->count();
$tniadkelbaru = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Kel'])->andwhere(['stpasien'=>'Baru'])->count();
$tniadmillama = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Old'])->count();
$tniadsiplama = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Sip'])->andwhere(['stpasien'=>'Old'])->count();
$tniadkellama = Pasien::find()->where(['idpekerjaan'=>3])->andwhere(['subid'=>'Kel'])->andwhere(['stpasien'=>'Old'])->count();

//TNI AL
$tnialmilall = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Mil'])->count();
$tnialsipall = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Sip'])->count();
$tnialkelall = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Kel'])->count();
$tnialmilbaru = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
$tnialsipbaru = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Sip'])->andwhere(['stpasien'=>'Baru'])->count();
$tnialkelbaru = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Kel'])->andwhere(['stpasien'=>'Baru'])->count();
$tnialmillama = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Old'])->count();
$tnialsiplama = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Sip'])->andwhere(['stpasien'=>'Old'])->count();
$tnialkellama = Pasien::find()->where(['idpekerjaan'=>4])->andwhere(['subid'=>'Kel'])->andwhere(['stpasien'=>'Old'])->count();
//polri
$polrimilall = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Mil'])->count();
$polrisipall = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Sip'])->count();
$polrikelall = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Kel'])->count();
$polrimilbaru = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Baru'])->count();
$polrisipbaru = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Sip'])->andwhere(['stpasien'=>'Baru'])->count();
$polrikelbaru = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Kel'])->andwhere(['stpasien'=>'Baru'])->count();
$polrimillama = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Mil'])->andwhere(['stpasien'=>'Old'])->count();
$polrisiplama = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Sip'])->andwhere(['stpasien'=>'Old'])->count();
$polrikellama = Pasien::find()->where(['idpekerjaan'=>12])->andwhere(['subid'=>'Kel'])->andwhere(['stpasien'=>'Old'])->count();


?>
<style>
th {

    text-align: center;

}
</style>
<?php
			$start = (isset($_GET['start']))? $_GET['start'] : date('d-M-Y');
			$end = (isset($_GET['end']))? $_GET['end'] : date('d-M-Y');
			$cek = (isset($_GET['cek']))? $_GET['cek'] : 'today';
			?>	
<div class='container-fluid' style='background:#fff;'>
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
								'format' => 'dd-M-yyyy',
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
								'format' => 'dd-M-yyyy',
								'todayHighlight' => true
							]
							]); ?>
						</div>
					</div>
					<a href="report?start=<?= $start ?>&end=<?= $end ?>&cek=<?= $cek ?>" target="blank" id="print_pdf" class="btn btn-danger" style='margin-top:22px;'><i class="fa fa-print" style="width:20px"></i>Print Pdf</a>
				</div>
					
	
				<div class='box box-body table-responsive' id='ajax_gridview'>
					
		<?php //echo $this->render('_search', ['model' => $searchModel]); ?>
				
			
				
		
		</div>
		
		
				
	</div>
</div>
<?php
$urlDataSearch = Url::to(['pengunjung/get-search']);
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
			
			$('#cek').attr('href', 'kunjungan?start='+start+'&end='+end+'&cek='+radio);
			$('#print_pdf').attr('href', 'report?start='+start+'&end='+end+'&cek='+radio);
			$('#start_date').attr('disabled', true);
			$('#end_date').attr('disabled', true);
		} else if(radio == 'this_month') {
			start = 1+'-'+nama_bulan[month]+'-'+year;
			end = lastday.toLocaleFormat('%d-%b-%Y');
			
			$('#cek').attr('href', 'kunjungan?start='+start+'&end='+end+'&cek='+radio);
			$('#print_pdf').attr('href', 'report?start='+start+'&end='+end+'&cek='+radio);
			$('#start_date').attr('disabled', true);
			$('#end_date').attr('disabled', true);
		} else if(radio == 'this_year') {
			start = 1+'-'+nama_bulan[0]+'-'+year;
			end = lastdayinyear.toLocaleFormat('%d-%b-%Y');
			
			$('#cek').attr('href', 'kunjungan?start='+start+'&end='+end+'&cek='+radio);
			$('#print_pdf').attr('href', 'report?start='+start+'&end='+end+'&cek='+radio);
			$('#start_date').attr('disabled', true);
			$('#end_date').attr('disabled', true);
		} else if(radio == 'custom') {
			start = $('#start_date').val();
			end = $('#end_date').val();
			
			$('#cek').attr('href', 'kunjungan?start='+start+'&end='+end+'&cek=custom');
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
		$('#cek').attr('href', 'kunjungan?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
		$('#print_pdf').attr('href', 'report?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
	});

	/*ini untuk mengeset end date ke button cek*/
	$('#end_date').on('change',function(){
		end = $(this).val();
		start = $('#start_date').val();
		getSearch(start,end);
		$('#cek').attr('href', 'kunjungan?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
		$('#print_pdf').attr('href', 'report?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
	});

	$('#btn-search').on('click', function(){
		end = $('#end_date').val();
		start = $('#start_date').val();
		getSearch(start,end);
		$('#cek').attr('href', 'kunjungan?start='+start+'&end='+end+'&cek=custom&search='+$('#textsearch').val());
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
