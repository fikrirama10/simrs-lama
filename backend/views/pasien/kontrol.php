<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use kartik\date\DatePicker;
use common\models\Jenisbayar;
use common\models\Dokter;
use kartik\checkbox\CheckboxX;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
use common\models\Poli;
/* @var $this yii\web\View */
/* @var $model common\models\Pasisen */

//$this->title = $model->no_rekmed;
$this->params['breadcrumbs'][] = ['label' => 'Pasien  > Kontrol', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

   <?php $form = ActiveForm::begin(); ?>
	<div class="rawatjalan-form"  style='margin-top:20px;'>
	<div class='container-fluid'>

		<div class='row'>
			<div class='col-md-4'>
				<div class='box box-warning'>
					<div class='box box-header'>
						<h3>Data Pasien</h3>
					</div>
					<div class='box box-body'>
						<div class='row'>
							<div class='col-xs-5'>RM</div>
							<div class='col-xs-6'><a>: <?= $model->no_rekmed ?></a></div>
						</div>
						<div class='row'>
							<div class='col-xs-5'>Nama Pasien</div>
							<div class='col-xs-6'><a>: <?= $model->nama_pasien ?></a></div>
						</div>
						<div class='row'>
							<div class='col-xs-5'>Agama</div>
							<div class='col-xs-6'><a>: <?= $model->agama ?></a></div>
						</div>
						<div class='row'>
							<div class='col-xs-5'>Golongan Darah</div>
							<div class='col-xs-6'><a>: <?= $model->gol_darah ?></a></div>
						</div>
						<div class='row'>
							<div class='col-xs-5'>Gender</div>
							<div class='col-xs-6'><a>: <?= $model->jenis_kelamin ?></a></div>
						</div>
					</div>
				</div>
			</div>
			<div class='col-md-8'>
				<div class='box box-danger'>
					<div class='box box-header'>

						<h3>Form Rawat Jalan</h3>
					</div>
					<div class='box box-body'>
					
						<?= $form->field($rawatjalan, 'no_rekmed')->textInput(['value'=>$model->no_rekmed,'readonly'=>true]) ?>
						<?= $form->field($rawatjalan, 'nosuratkontrol')->textInput(['placeholder'=>'Isi Jika Ada'])->label('Nomor Surat Kontrol') ?>
						<?= $form->field($lograwat, 'rm')->hiddeninput(['value'=>$model->no_rekmed])->label(false) ?>
						<?= $form->field($rawatjalan, 'idpoli')->dropDownList(ArrayHelper::map(Poli::find()->all(), 'id', 'namapoli'),['prompt'=>'- Poli Yang Dituju -','onchange'=>'$.get("'.Url::toRoute('pasien/listdok/').'",{ id: $(this).val() }).done(function( data ) 
							{
								  $( "select#rawatjalan-iddokter" ).html( data );
								});
						
							'])->label('Pilihan Poli',['class'=>'label-class'])->label()?>
						
														<?=	$form->field($rawatjalan, 'tgldaftar')->widget(DatePicker::classname(),[
						'type' => DatePicker::TYPE_COMPONENT_APPEND,
						'pluginOptions' => [
						'autoclose'=>true,
						'format' => 'yyyy-mm-dd',
						'todayHighlight' => true,
						]
						])->label('Jadwal Berobat');?>

					
						<?= $form->field($rawatjalan, 'iddokter')->dropDownList(ArrayHelper::map(Dokter::find()->where(['id'=>0])->all(), 'id', 'namadokter'),['prompt'=>'- Pilih Dokter -'])->label('Dokter',['class'=>'label-class'])->label()?>
						<?= $form->field($rawatjalan, 'idbayar')->dropDownList(ArrayHelper::map(Jenisbayar::find()->all(), 'id', 'jenisbayar'),['prompt'=>'- Pilih Jenisbayar -'])->label('',['class'=>'label-class'])->label()?>
							
						<input type="checkbox"  name="Rawatjalan[anggota]" id="lengkap" value="1">Anggota
					</div>
				</div>
				<div class='box box-default'>
				<div class='box box-body'>
					<div class="form-grup">
					<?= Html::submitButton('Simpan', ['class' => 'btn btn-success','id'=>'add-rawat']) ?>
						
					</div>
				</div>
			</div>
			
			
			
			</div>
		</div>
		
    <div class="form-group">
      
    </div>

<?php ActiveForm::end();  ?>

		
   
</div>
    

</div>
<?php 
$urlDataTransaksiDetail = Url::to(['transaksi/get-data-transaksidetail']);
$urlSaveTransdataAjax = Url::to(['transaksi/save-transdata-ajax']);
$urlDataTransaksiId = Url::to(['transaksi/get-transaksi-id']);
$urlDataBarangStok = Url::to(['transaksi/get-barang-stok']);
$urlDeleteAll = Url::to(['transaksi/delete-all']);
$urlSaveAjax = Url::to(['transaksi/save-ajax']);
$urlIndex = Url::to(['transaksi/index']);
$urlCreate = Url::to(['transaksi/create']);
$urlPrint = Url::to(['transaksi/export']);
$this->registerJs("

	// $('input[name=r2]').on('change',function(){
		// var radio = $(this).val();
	// });

	$('#transaksi-ongkir-disp').attr('disabled', true);
	
	$('#cekongkir').on('change', function(){
		paket = this.checked;
		if(paket == 1){
			$('#transaksi-ongkir-disp').attr('disabled', false);
			$('.congkir').removeClass('displaynone');
		}else if(paket == 0){
			$('#transaksi-ongkir-disp').val('0.00');
			$('#transaksi-ongkir-disp').attr('disabled', true);
			$('.congkir').addClass('displaynone');
		}else{
			$('#transaksi-ongkir-disp').val('0.00');
			$('#transaksi-ongkir-disp').attr('disabled', true);
			$('.congkir').addClass('displaynone');
		}
	});

	$('#transaksidetail-discount').attr('disabled', true);
	
	$('#cekdiskon').on('change', function(){
		paket = this.checked;
		if(paket == 1){
			$('#transaksidetail-discount').attr('disabled', false);
		}else if(paket == 0){
			$('#transaksidetail-discount').val(0);
			$('#transaksidetail-discount').attr('disabled', true);
		}else{
			$('#transaksidetail-discount').val(0);
			$('#transaksidetail-discount').attr('disabled', true);
		}
		// console.log(paket);
	});

	$('#transaksidetail-discount').on('keyup', function(){
		diskon = parseInt($(this).val().replace(/\,/g,''));
		if(diskon > 100){
			diskon = 100;
		}else{
			diskon = diskon;
		}
		subtotal = parseInt($('#sub-total').val().replace(/\,/g,''));
		total = subtotal * diskon / 100;
		// $('#transaksi-discount-disp').val(total);
		$('#diskon-temp').val(total);
	});

	$('#transaksi-ongkir-disp').on('keyup', function(){
		ongkir = parseInt($(this).val().replace(/\,/g,''));
		total = parseInt($('#old-grand-total').val().replace(/\,/g,''));
		grandtotal = total + ongkir;
		// console.log(format_money(grandtotal, ' '));
		$('#transaksi-grandtotal-disp').val(format_money(grandtotal, ' '));
		console.log(total);
	});
	
	/*set grand total auto*/
	var gtotal = parseInt($('#transaksi-grandtotal-disp').val().replace(/\,/g,''));
	$('#terbilang').html(terbilang_js(gtotal));
	$('#grand-total').html(format_money(gtotal, ' '));
	$('#old-grand-total').val(format_money(gtotal, ' '));

	/*ini untuk membatalkan transaksi*/
	$('#delete-all').on('click',function(){
		if (confirm('Apakah Anda yakin akan membatalkan transaksi ini ?')) {
			trxid = $('#transaksi-trxid').val();
			$.ajax({
				type: 'GET',
				url: '{$urlDeleteAll}',
				data: 'id='+trxid,
				success: function (data) {
					$('body,html').animate({ scrollTop: 0 }, 200);
					$('#transaksi-ajax').html(data);
					getTransaksiDetail(trxid);
					setTimeout(function () {
						location.reload();
					}, 2000); //will call the function after 2 secs.
					console.log(data);
				},
			});
		}
	});

	/*ini untuk save data transaksi detail*/	
	$('#add-barang').on('click',function(){

		trxid = $('#transaksi-trxid').val();
		tanggal = $('#transaksi-tanggal').val();
		qty = $('#transaksidetail-qty').val();
		subtotal = $('#sub-total').val().replace(/\,/g,'');
		diskon = $('#diskon-temp').val().replace(/\,/g,'');
		idstat = 1;
		idcust = $('#customer-idcust').val();
		keterangan = $('#transaksi-keterangan').val();
		idmarket = $('#idmarket').val();
		marketing = $('#marketing').val();
		
		idstok = $('#idstok').val();
		kode = $('#transaksidetail-kode').val();
		harga = $('#transaksidetail-harga-disp').val().replace(/\,/g,'');
		
		bayar = $('#transaksidata-bayar-disp').val().replace(/\,/g,'');
		kembali = $('#transaksidata-kembali-disp').val().replace(/\,/g,'');

		ongkir = $('#transaksi-ongkir-disp').val().replace(/\,/g,'');
		ekspedisi = $('#transaksidata-ekspedisi').val();
		resi = $('#transaksidata-resi').val();
		alamattujuan = $('#transaksidata-alamattujuan').val();

		if(bayar == null && kembali == null){
			bayar = 0;
			kembali = 0;
		}else{
			bayar = bayar;
			kembali = kembali;
		}

		if(ongkir == null){ ongkir = 0;}else{ ongkir = ongkir;}
		
		if(qty == 0 || qty == '' ){
			alert('Silahkan isi qty barang yang akan dibeli !');
		}else{
		
		if(kode !== '' && tanggal !== '' && trxid !== ''){
			$.ajax({
				type: 'POST',
				url: '{$urlSaveAjax}',
				data: {TrxId:trxid, Tanggal:tanggal, Qty:qty, SubTotal:subtotal, Diskon:diskon, IdStat:idstat, Keterangan:keterangan, Kode:kode, Harga:harga, IdCust:idcust, IdStok:idstok, Bayar:bayar, Kembali:kembali, Ongkir:ongkir, Ekspedisi:ekspedisi, Resi:resi, AlamatTujuan:alamattujuan, IdMarket:idmarket, Marketing:marketing},
				// dataType: 'json',
				success: function (data) {
					if(data !== null){
						$('body,html').animate({ scrollTop: 0 }, 200);
						$('#transaksi-ajax').html(data);
						$('.kosong').val('');
						$('.nol').val('0');
						$('.nolkoma').val('0.00');
						getTransaksiDetail(trxid);
						getBarangStok();
					}
				},
				error: function (exception) {
					console.log(exception);
				}
			});
		}else{
			$('body,html').animate({ scrollTop: 0 }, 200);
			// $('#purchase-order-ajax div').removeClass('displaynone');
			// setTimeout(function () {
				// $('#purchase-order-ajax div').addClass('displaynone');
			// }, 2000); //will call the function after 2 secs.
		}
		
		}
	});

	/*ini untuk hitung sub total */
	$('#transaksidetail-qty').on('keyup',function(){
		qtybarang = parseInt($(this).val());
		stokakhir = parseInt($('#stokakhir').val());
		if(qtybarang > stokakhir){
			alert('Qty tidak boleh lebih dari stok akhir');
			$('#transaksidetail-qty').val(0);
		}else if(qtybarang <= stokakhir){
			hargabarang = parseInt($('#transaksidetail-harga-disp').val().replace(/\,/g,''));
			subtotal = parseFloat(qtybarang * hargabarang);
			$('#sub-total').val(format_money(subtotal, ''));
		}
	});
	
	/*ini untuk hitung kembalian */
	$('#transaksidata-bayar-disp').on('keyup',function(){
		bayar = parseInt($(this).val().replace(/\,/g,''));
		grandtotal = parseInt($('#transaksi-grandtotal-disp').val().replace(/\,/g,''));
		kembali = parseFloat(bayar - grandtotal);
		$('#transaksidata-kembali-disp').val(format_money(kembali, ''));
	});
	
	/*ini untuk save data transaksi detail*/	
	$('#bayar').on('click',function(){
		if (confirm('Apakah Anda yakin akan menutup transaksi ini ?')) {
		bayar = $('#transaksidata-bayar-disp').val().replace(/\,/g,'');
		grandtotal = parseInt($('#transaksi-grandtotal-disp').val().replace(/\,/g,''));
		idcust = $('#customer-idcust').val();
		if(idcust == null || idcust == ''){
			if(bayar == '0.00' || bayar == null){
				$('body,html').animate({ scrollTop: 0 }, 200);
				alert('Silahkan bayar terlebih dahulu');
			}else if(parseInt(bayar) < grandtotal){
				$('body,html').animate({ scrollTop: 0 }, 200);
				alert('Pembayaran masih kurang');
			}else{
				saveTransaksiData();
				// alert('tunai');
			}
		}else{
			saveTransaksiData('piutang');
			// alert('piutang');
		}
		}
	});

	/*ini untuk save data transaksi detail*/	
	$('#simpan').on('click',function(){
		saveTransaksiData('simpan');
	});
	
	function saveTransaksiData(status) {
	
		trxid = $('#transaksi-trxid').val();
		idcust = $('#customer-idcust').val();
		bayar = $('#transaksidata-bayar-disp').val().replace(/\,/g,'');
		kembali = $('#transaksidata-kembali-disp').val().replace(/\,/g,'');
		
		ongkir = $('#transaksi-ongkir-disp').val().replace(/\,/g,'');
		ekspedisi = $('#transaksidata-ekspedisi').val();
		resi = $('#transaksidata-resi').val();
		alamattujuan = $('#transaksidata-alamattujuan').val();
		
		$.ajax({
			type: 'POST',
			url: '{$urlSaveTransdataAjax}',
			data: {TrxId:trxid, Bayar:bayar, Kembali:kembali, Status:status, IdCust:idcust, Ongkir:ongkir, Ekspedisi:ekspedisi, Resi:resi, AlamatTujuan:alamattujuan},
			// dataType: 'json',
			success: function (data) {
				if(data !== null){
					$('body,html').animate({ scrollTop: 0 }, 200);
					$('#transaksi-ajax').html(data);
					var radio = $('input[name=r2]').val();
					setTimeout(function () {
						// window.location.reload();
						if(status !== 'simpan'){
							if(radio == 'print'){
								window.open('{$urlPrint}'+'?trxid='+trxid,'_blank');
							}
						}
						window.location.href='{$urlCreate}';
					}, 2000); //will call the function after 2 secs.
				}
			},
			error: function (exception) {
				console.log(exception);
			}
		});
	}

	function getBarangStok() {
		$.ajax({
			url: '{$urlDataBarangStok}',
			type: 'POST',
			data: {id:kode},
			success: function(data){
				$('#tabel-data-barang').html(data);
			}
		});
	}
	
	function getTransaksiDetail(kode) {
		$.ajax({
			url: '{$urlDataTransaksiDetail}',
			type: 'POST',
			data: {id:kode},
			success: function(data){
				getTransaksiId(kode);
				$('#tabel-transaksi-detail').html(data);
			}
		});
	}
	
	function getTransaksiId(kode) {
		$.ajax({
			url: '{$urlDataTransaksiId}',
			type: 'POST',
			data: {id:kode},
			dataType: 'json',
			success: function(data){
				if(data !== null){
					var res = JSON.parse(JSON.stringify(data));
					total = parseFloat(res.Total);
					diskon = parseFloat(res.Discount);
					grandtotal = parseFloat(res.GrandTotal);
					$('#terbilang').html(terbilang_js(grandtotal));
					$('#grand-total').html(format_money(grandtotal, ' '));
					$('#old-grand-total').val(format_money(grandtotal, ' '));
					$('#transaksi-total-disp').val(format_money(total, ' '));
					$('#transaksi-discount-disp').val(format_money(diskon, ' '));
					$('#transaksi-grandtotal-disp').val(format_money(grandtotal, ' '));
				}
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
?>
