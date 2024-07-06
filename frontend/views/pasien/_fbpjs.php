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
				<h3><span class='fa fa-print'></span> Data Pasien BPJS</h3>
				
			</div>
			<div class='box box-body'>
				<div class='row'>
					
					<div class='col-md-12'>
						<?= $form->field($model, 'no_identitas',['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']])->textInput(['value'=> $kelas['noKartu']],['maxlength' => true])->label('NO KARTU BPJS') ?>
					</div>
				</div>
				<div class='row'>
				
					<div class='col-md-2'>
						<?= $form->field($model, 'sbb')->dropDownList([ 'By' => 'By', 'An' => 'An', 'Tn' => 'Tn', 'Ny' => 'Ny', 'Nn' => 'Nn' , ]) ?>
					</div>
					
					<div class='col-md-10'>
						<?= $form->field($model, 'nama_pasien')->textInput(['value' => $kelas['nama']],['maxlength' => true]) ?>
					</div>
					
			
				</div>
				<div class='row'>
					<div class='col-md-4'>
						<?= $form->field($model, 'tempat_lahir')->textInput(['placeholder' => "Tempat Lahir"],['maxlength' => true]) ?>
					</div>
					
					<div class='col-md-4'>
					<?=	$form->field($model, 'tanggal_lahir')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'value'=>'',
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
					<div class='col-md-3'>
						<?= $form->field($model,'idprov')->dropDownList(ArrayHelper::map(Provinsi::find()->all(),'id_prov','nama'),[
						'prompt'=>'- Pilih Provinsi -',
						'onchange'=>'$.get("'.Url::toRoute('pasien/list/').'",{ id: $(this).val() }).done(function( data ) 
							{
								  $( "select#pasien-idkab" ).html( data );
								});
							'
						])->label();?>
					</div>
					<div class='col-md-3'>
						<?= $form->field($model, 'idkab')->dropDownList(ArrayHelper::map(Kabupaten::find()->where(['id_kab'=>0])->all(), 'id_kab', 'nama'),['prompt'=>'- Pilih Kota -','onchange'=>'$.get("'.Url::toRoute('pasien/listkec/').'",{ id: $(this).val() }).done(function( data ) 
							{
								  $( "select#pasien-idkec" ).html( data );
								});
							'])->label('Kota',['class'=>'label-class'])->label()?>
                   
					</div>
					<div class='col-md-3'>
						<?= $form->field($model, 'idkec')->dropDownList(ArrayHelper::map(Kecamatan::find()->where(['id_kec'=>0])->all(), 'id_kec', 'Kecamatan'),['prompt'=>'- Pilih Kecamatan -','onchange'=>'$.get("'.Url::toRoute('pasien/listkel/').'",{ id: $(this).val() }).done(function( data ) 
							{
								  $( "select#pasien-idkel" ).html( data );
								});
							'])->label('Kecamatan',['class'=>'label-class'])->label()?>
                   
					</div>
					<div class = 'col-md-3 '>
						<?= $form->field($model, 'idkel')->dropDownList(ArrayHelper::map(Kelurahan::find()->where(['id_kel'=>0])->all(), 'id_kel', 'Kelurahan'),['prompt'=>'- Pilih Kelurahan -'])->label('Kelurahan',['class'=>'label-class'])->label()?>
                   
					</div>
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
			<div class='box box-info'>
				<div class='box box-header'>
					<h3>Data pekerjaan</h3>
				</div>
				<div class='box box-body'>
					<div class='row'>
						
						<div class='col-md-10'>
							 <?= $form->field($pekerjaan, 'idjenis')->dropDownList(ArrayHelper::map(Jenispekerjaan::find()->all(), 'id', 'jenis'))?>
						</div>
					</div>
					<div class='row'>
					
						<div class='col-md-10'>
							<label id='pangkat'>pangkat</label>
							 <?= $form->field($pekerjaan, 'pangkat')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					<div class='row'>
					
						<div class='col-md-10'>
							<label id='nrp'> NRP </label>
							 <?= $form->field($pekerjaan, 'nrp')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					<div class='row'>
					
						<div class='col-md-10'>
							<label id='kesatuan'> Kesatuan </label>
							 <?= $form->field($pekerjaan, 'kesatuan')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					</div>
					<div class='row'>
						
						<div class='col-md-10'>
							 <?= $form->field($pekerjaan, 'alamat_kerja')->textarea(['rows' => 6]) ?>			
						</div>
					</div>
					<div class='row'>
					
						<div class='col-md-9'>
							 <?= $form->field($pekerjaan, 'notlp')->textInput(['maxlength' => true]) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class='col-md-7'></div>
		<div class='col-md-5'>
			<div class='box box-default'>
				<div class='box box-body'>
					<div class="form-grup">
						<?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
					</div>
				</div>
			</div>
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
	
	
	
	function format_money(n, currency) {
		return currency + ' ' + n.toFixed(2).replace(/./g, function(c, i, a) {
			return i > 0 && c !== '.' && (a.length - i) % 3 === 0 ? ',' + c : c;
		});
	}


", View::POS_READY);
?>
