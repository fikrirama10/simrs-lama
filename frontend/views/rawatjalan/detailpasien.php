<?php	
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
use common\models\Diagnosa;
use common\models\Kesadaran;
use yii\helpers\ArrayHelper;

use Picqer\Barcode\BarcodeGeneratorHTML;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
if($model->status != 2){
	echo"Pasien Dalam Tahap ".$model->sttatus->status."";
}else{
?>
<div class="container-fluid" style='background:#fff;'>


  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Data Pasien</a></li>
    <li><a data-toggle="tab" href="#menu1"> Anamnesa / Anamnesis</a></li>
    <li><a data-toggle="tab" href="#menu2">Pemeriksaan Fisik</a></li>
    <li><a data-toggle="tab" href="#menu3">Rx Radiologi</a></li>
    <li><a data-toggle="tab" href="#menu4">Diagnosis</a></li>
    <li><a data-toggle="tab" href="#menu5">Selesai</a></li>
  </ul>
 <?php $form = ActiveForm::begin(); ?>
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
	<div class='box box-body'>
					<div class='row'>
						<div class='col-xs-8'>
							<a class='nama_pasien'><?= $model->pasien->sbb ?>. <?= $model->pasien->nama_pasien ?></a> <a class='jenis_kelamin'>( <?= $model->pasien->jenis_kelamin ?> )</a> , 
						</div>
						<div class='col-xs-4 cs'>
							
							<?= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($model->no_rekmed, $generator::TYPE_CODE_128)) . '">'; ?>
						</div>
						
						<div class='col-md-12 bt10' >
						RM : <a style='padding-right:20px; font-size:20px;'><?= $model->no_rekmed ?></a>  
						</div>		
						<div class='col-md-12 bt10' >
						Usia : <a style='padding-right:20px; font-size:20px;'><?= $model->pasien->usia ?></a>  
						</div>		
						<div class='col-md-12 bt10' >
						Golongan darah  : <a style='padding-right:20px; font-size:20px;'><?= $model->pasien->gol_darah ?></a>  
						</div>	
						<div class='col-md-12 bt10' >
						Agama : <a style='padding-right:20px; font-size:20px;'> <?= $model->pasien->agama ?></a>  
						</div>	
					</div>
					</div>
     
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3> Anamnesa / Anamnesis</h3>
    
		<div class='row'>
			<div class='col-md-8'>
				<?= $form->field($keluhan, 'no_rekmed')->hiddeninput(['value'=>$model->no_rekmed])->label(false) ?>
				<?= $form->field($keluhan, 'kode_p')->hiddeninput(['value'=>$model->idrawat])->label(false) ?>
				<?= $form->field($keluhan, 'idpemeriksa')->hiddeninput(['value'=>Yii::$app->user->identity->dokter->id])->label(false) ?>
				<?= $form->field($keluhan, 'keluhan')->textarea(['rows' => '6'])->label("Keluhan Sekarang")?>
				<?= $form->field($keluhan, 'rwt_penyakits')->textarea(['rows' => '4'])->label("Riwayat Penyakit Sekarang")?>
				<?= $form->field($keluhan, 'alergi')->textinput(['placeholder'=>'Kosongkan jika tidak ada'])->label("Alergi") ?>
				
				
			</div>
		</div>
		
		
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Pemeriksaan Fisik</h3>
	  <?= $form->field($rxfisik, 'kesadaran')->dropDownList(ArrayHelper::map(Kesadaran::find()->all(), 'id','kesadaran'))?>
	<?= $form->field($rxfisik, 'no_rawat')->hiddeninput(['value'=>$model->idrawat])->label(false) ?>
	<?= $form->field($rxfisik, 'rx_fisik')->textarea()->label("Pemeriksaan Fisik") ?>
	<?= $form->field($rxfisik, 'tinggibadan')->textinput(['placeholder'=>'cm']) ?>
	<?= $form->field($rxfisik, 'beratbadan')->textinput(['placeholder'=>'kg']) ?>
	<?= $form->field($rxfisik, 'tekanandarah')->textinput(['placeholder'=>'mmHg']) ?>
	
    </div>
    <div id="menu3" class="tab-pane fade">
       <h3>Rx Labor</h3>
	<?= $form->field($rxlabor, 'idrawat')->hiddeninput(['value'=>$model->idrawat])->label(false) ?>
	<?= $form->field($rxlabor, 'rx_labor')->textarea() ?>
    </div>
	<div id="menu4" class="tab-pane fade">
      <h3>Diagnosa</h3>
				<?= $form->field($model, 'kdiagnosa')->dropDownList(ArrayHelper::map(Diagnosa::find()->all(), 'kodediagnosa','kodediagnosa', 'diagnosa'))?>
				<?= $form->field($model, 'ketdiag')->textarea() ?>
    </div>
	<div id="menu5" class="tab-pane fade">
       <h3>Selesai Pemeriksaan</h3>
       <h4>Klik simpan untuk menu selanjutnya</h4>
       <h5>*Sesudah klik simpan data tidak dapat di ubah pastikan data terisi dengan benar</h5>
		 <?= Html::submitButton('Simpan', ['class' => 'btn btn-success pdd10']) ?>
    </div>
  </div>
 
    <?php ActiveForm::end(); ?>
</div>

<?php  

$this->registerJs("

	$('#laminating').addClass('disabel');
	$('#finishing').addClass('disabel');
	$('.wew').addClass('disabel');
	$('.bot').addClass('disabel');
	

         
			$('#ya').on('checked',function(){
				
				
			})

            $('#pasien-tanggal_lahir').on('change',function() {
                var dob = new Date(this.value);
                var today = new Date();
                var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
                $('#pasien-usia').val(age);
            });
			$('#pekerjaan-idjenis').on('change',function() {
                var dob = $('#pekerjaan-idjenis').val();
                if(dob > 2){
				$('#pekerjaan-pangkat').addClass('disabel');
				$('#pangkat').addClass('disabel');
				$('#pekerjaan-nrp').addClass('disabel');
				$('#nrp').addClass('disabel');
				$('#pekerjaan-kesatuan').addClass('disabel');
				$('#kesatuan').addClass('disabel');
				}else{
				$('#pangkat').removeClass('disabel');
				$('#pekerjaan-pangkat').removeClass('disabel');	
				$('#nrp').removeClass('disabel');
				$('#pekerjaan-nrp').removeClass('disabel');	
				$('#kesatuan').removeClass('disabel');
				$('#pekerjaan-kesatuanm,').removeClass('disabel');	
				}
				
                $('#pekerjaan-kesatuan').val(dob);
            });
        
 
	
	$('#bahan').on('change',function(){
		id = $('#bahan').val();
	
		if(id){
			getBahan(id);
			$('#laminating').removeClass('disabel');
			$('.wew').removeClass('disabel');
			$('.bot').removeClass('disabel');
			$('#bahanjadi').val(id);
		}else{
			$('.nol').val(0);
			$('.nol-html').html('Rp. 0');
			$('#laminating').addClass('disabel');
			$('.wew').addClass('disabel');
			$('.bot').addClass('disabel');
			
			
			// var q = $('#qty').val();
			// hargaawal = parseInt($('#harga').val() );
			// var panjang = $('#panjang').val();
			// var lebar = $('#lebar').val();
			// var luar = panjang * lebar;
			// lami = parseInt($('#lamina').val() );
			// $('#subtotal').val(hargaawal);
			// $('#hh').html( format_money(hargaawal * q,'Rp. '));
		}
		
	});
	
	$('#bahanlarge').on('change',function(){
		id = $('#bahanlarge').val();
	
		if(id){
			getBahan(id);
			$('#finishing').removeClass('disabel');
			$('.wew').removeClass('disabel');
			$('.bot').removeClass('disabel');
			$('#bahanjadi').val(id);
		}else{
			$('.nol').val(0);
			$('.nol-html').html('Rp. 0');
			$('#laminating').addClass('disabel');
			$('.wew').addClass('disabel');
			$('.bot').addClass('disabel');
			
			
			var q = $('#qty').val();
			hargaawal = parseInt($('#harga').val() );
			var panjang = $('#panjang').val();
			var lebar = $('#lebar').val();
			var luar = panjang * lebar;
			lami = parseInt($('#lamina').val() );
			//$('#subtotallh').val(hargaawal);
			//$('#hh').html( format_money(hargaawal * q ,'Rp. '));
		}
		
	});
	
	$('#laminating').on('change',function(){
		id = $('#laminating').val();
		i = getLaminating(id);
		 if(id){
			var q = $('#qty').val();
			hargaawal = parseInt($('#bahanlaminating').val() );
			hargalami = parseInt($('#lamina').val());
			$('#hh').html(format_money( (hargaawal + hargalami) * q,'Rp. '));
			$('#bahanlami').val(id);
		}else{
			var q = $('#qty').val();
			hargaawal = parseInt($('#bahanlaminating').val() );
			hargalami = parseInt($('#lamina').val());
			$('#hh').html(format_money( hargaawal * q,'Rp. '));
		}
		
	
			
		
			
		
	 });
	 $('#finishing').on('change',function(){
		id = $('#finishing').val();
		getFinishing(id);
		$('#fin').val(id);
	});
	 	$('#kertas').on('change',function(){
		id = $('#kertas').val();
		i = getKertas(id);
		// if(id){
			var q = $('#qty').val();
			hargaawal = parseInt($('#bahanlaminating').val() );
			hargalami = parseInt($('#kert').val());
			$('#hh').html(format_money( (hargaawal + hargalami) * q,'Rp. '));
		// }
		
			
		
			
		
	 });

	$('#qty').on('keyup',function(){

		hargaawal = parseInt($('#bahanlaminating').val() );
		harbah = parseInt($('#lamina').val() );
		var qty = $('#qty').val();
		var panjang = $('#panjang').val();
		var lebar = $('#lebar').val();
		var total = panjang * lebar * hargaawal + harbah ;
		var totalq = (total + harbah)  * qty;
		$('#hh').html(format_money(totalq,'Rp. '));
		$('#subtotalhl').val(totalq)
		
	});
	
	$('#panjang').on('keyup',function(){

		hargaawal = parseInt($('#bahanlaminating').val() );
		var panjang = $('#panjang').val();
		var lebar = $('#lebar').val();
		var qty = $('#qty').val();
		var total = panjang * lebar * hargaawal ;
		var totalq = total * qty;
		var tot = panjang * lebar ;
		$('#tot').html(tot);
		$('#hh').html(format_money(totalq,'Rp. '));
		
		
	});
	
	
	
	$('#lebar').on('keyup',function(){

		hargaawal = parseInt($('#bahanlaminating').val() );
		var panjang = $('#panjang').val();
		var lebar = $('#lebar').val();
		var qty = $('#qty').val();
		var total = panjang * lebar * hargaawal * qty ;
		$('#hh').html(format_money(total,'Rp. '));
		var tot = panjang * lebar ;
		$('#tot').html(tot);
		
	});
	
	

	
	// Harga Kertas 
	
	
	
	function format_money(n, currency) {
		return currency + ' ' + n.toFixed(2).replace(/./g, function(c, i, a) {
			return i > 0 && c !== '.' && (a.length - i) % 3 === 0 ? ',' + c : c;
		});
	}


", View::POS_READY);}
?>
