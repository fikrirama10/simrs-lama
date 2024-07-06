<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
use common\models\StatusHub;
use common\models\Provinsi;
use common\models\Kelurahan;
use common\models\Kabupaten;
use common\models\Kecamatan;
use common\models\Jenispekerjaan;
use kartik\date\DatePicker;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model common\models\Pasisen */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="pasisen-form">

    <?php $form = ActiveForm::begin(); ?>
	<div class='container-fluid'>
	<!-- Form Pasien -->
	<div class='row'>
		<div class='col-md-7'>
		<div class='box box-default'>
			<div class='box box-header'>
				<h3><span class='fa fa-print'></span> Data Pasien </h3>
				<a class='btn btn-warning' href='<?= Yii::$app->params['baseUrl'].'/dashboard/pasien/kirim/'?>'>Pdf</a>
			</div>
			<div class='box box-body'>
				<div class='row'>
					
					<div class='col-md-12'>
						<?= $form->field($model, 'no_identitas',['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']])->textInput(['placeholder' => "No identitas"],['maxlength' => true]) ?>
					</div>
				</div>
				<div class='row'>
					
					<div class='col-md-12'>
						<?= $form->field($model, 'nobpjs',['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']])->textInput(['placeholder' => "No Bpjs"],['maxlength' => true]) ?>
					</div>
				</div>
				<div class='row'>
				
					
					
					<div class='col-md-12'>
						<?= $form->field($model, 'nama_pasien')->textInput(['placeholder' => "Nama Lengkap"],['maxlength' => true]) ?>
					</div>
					
			
				</div>
				<div class='row'>
					<div class='col-md-4'>
						<?= $form->field($model, 'tempat_lahir')->textInput(['placeholder' => "Tempat Lahir"],['maxlength' => true]) ?>
					</div>
					
					<div class='col-md-4'>
					<?=	$form->field($model, 'tanggal_lahir')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					]);?>
					</div>
					<div class='col-md-4'>
					<?= $form->field($model, 'usia')->textInput(['placeholder' => "Usia"],['maxlength' => true]) ?>
					</div>
				</div>
				<div class='row'>
					<div class='col-md-3'>
						<?= $form->field($model, 'agama')->dropDownList([ 'Islam' => 'Islam', 'Khatolik' => 'Khatolik', 'Protestan' => 'Protestan', 'Hindu' => 'Hindu', 'Budha' => 'Budha' ,'Kong Hu Cu' => 'Kong Hu Cu', ]) ?>
					</div>
					<div class='col-md-3'>
						<?= $form->field($model, 'jenis_kelamin')->dropDownList([ 'L' => 'L', 'P' => 'P', ], ['prompt' => 'Jenis Kelamin']) ?>
					</div>
					<div class='col-md-3'>
					<?= $form->field($model, 'id_status')->dropDownList(ArrayHelper::map(StatusHub::find()->all(), 'id', 'status_hub'))?>
					</div>
				
					
					<div class='col-md-3'>
					<?= $form->field($model, 'gol_darah')->dropDownList([ '-'=>'','O' => 'O', 'B' => 'B', 'A' => 'A', 'AB' => 'AB', ], ['prompt' => 'Golongan Darah']) ?>
					</div>
				
					
					
				</div>

				<div class='row'>
				
				</div>
				
				<div class='row'>
					
					<div class='col-md-12'>
						 <?= $form->field($model, 'alamat')->textarea(['rows' => 3]) ?>
					</div>
				</div>
				<div class='row'>
					
					<div class='col-md-3'>
						<?= $form->field($model, 'kodepos')->textInput(['maxlength' => true]) ?>
					</div>
					
					<div class='col-md-9'>
						<?= $form->field($model, 'nohp')->textInput(['maxlength' => true]) ?>
					</div>
				</div>
				
			</div>
		</div>
		</div>
		<div class='col-md-5'>
			<div class='box box-warning'>
				<div class='box box-header'>
					<h3>Data Medis Pasien</h3>
				</div>
				<div class='box box-body'>
					<div class='row'>
					
						<div class='col-md-9'>
							<?php ($model->no_rekmed)? $model->no_rekmed : $model->genKode() ?>
							<?= $form->field($model, 'no_rekmed')->textInput(['maxlength' => true]) ?>
							<?=$form->field($model, 'nilaikeyakinan', [
							'template' => '{input}{label}{error}{hint}',
							'labelOptions' => ['class' => 'cbx-label']
							])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Nilai Keyakinan'); 
							?>
						</div>
					</div>
					
					<div class='row'>
						
						<div class='col-md-9'>
							
						</div>
					</div>
					
					<div class='row'>
						
						<div class='col-md-9'>
							 
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class='col-md-5'>
			<div class='box box-default'>
				<div class='box box-body'>
					<div class="form-grup">
						<?= Html::submitButton('Simpan', ['class' => 'btn btn-success','id'=>'confirm']) ?>
				</div>
			</div>
		</div>
	</div>
	
    <?php ActiveForm::end(); ?>

</div>
<?php 
$pass = Yii::$app->user->identity->password_repeat;
$this->registerJs("

	$('#laminating').addClass('disabel');
	$('#finishing').addClass('disabel');
	$('.wew').addClass('disabel');
	$('.bot').addClass('disabel');
	

         
 

            $('#pasien-tanggal_lahir').on('change',function() {
                var dob = new Date(this.value);
                var today = new Date();
                var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
                $('#pasien-usia').val(age);
            });
			 $('#pasiensearch-no_rekmed').on('keyup',function() {
				  $('#pasiensearch-no_rekmed').html('1');
             
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
				$('#pekerjaan-kesatuan,').removeClass('disabel');	
				}
				
                //$('#pekerjaan-kesatuan').val(dob);
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
	
	 $('#confirm').on('click', function(event){
	age =  prompt('Masukan Kode Verifikasi?', );
	if(age == '{$pass}'){
       return true;
    } else {
        event.preventDefault();
        alert('Password salah');
    }
    });
	
	function format_money(n, currency) {
		return currency + ' ' + n.toFixed(2).replace(/./g, function(c, i, a) {
			return i > 0 && c !== '.' && (a.length - i) % 3 === 0 ? ',' + c : c;
		});
	}


", View::POS_READY);
?>
