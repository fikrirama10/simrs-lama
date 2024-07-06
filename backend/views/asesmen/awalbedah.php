<?php	
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
use common\models\Diagnosa;
use common\models\Dokter;
use common\models\Perawat;
use common\models\Kesadaran;
use yii\helpers\ArrayHelper;

use Picqer\Barcode\BarcodeGeneratorHTML;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
if($model->status == 0){
	echo"Pasien Dalam Tahap ".$model->sttatus->status."";
}else{
?>
<div class="container-fluid" style='background:#fff; padding-top:10px;'>
 <?php $form = ActiveForm::begin(); ?>
<label>Dokter Pemeriksa</label>
<h4><?= $model->dokter->namadokter ?></h4>


<div class='row'>
	<div class='col-md-3'>
		<div class="box box-primary">
			<div class="box-body box-profile">
			<h3 class="profile-username text-center"><?= $model->pasien->sbb ?>. <?= $model->pasien->nama_pasien ?></h3>
			<p class="text-muted text-center" style='font-size:18px;'><b><?= $model->no_rekmed ?></b></p>
			<hr>
               <strong><i class="fa fa-venus-mars margin-r-5"></i> Jenis Kelamin</strong>

              <p class="text-muted">
				<?php if($model->pasien->jenis_kelamin == 'L'){echo"Laki - Laki";}else{echo"Perempuan";}?>
              </p>

              <hr>

              <strong><i class="fa fa-birthday-cake margin-r-5"></i>Tanggal Lahir </strong>

              <p class="text-muted"><?= date('d F Y',strtotime($model->pasien->tanggal_lahir))?> ( <?=$model->pasien->usia?>th )</p>

              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"><?= $model->pasien->alamat?></p>

              <hr>
			  <strong><i class="fa fa-balance-scale margin-r-5"></i> Agama</strong>

              <p class="text-muted"><?= $model->pasien->agama?></p>

              <hr>
               <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary btn-block']) ?>
            </div>
            <!-- /.box-body -->
          </div>
	</div>
	<div class='col-md-8'>
		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li><a href="#tab_1-1" data-toggle="tab">Diagnosis Awal</a></li>
              <li><a href="#tab_2-2" data-toggle="tab">Pemeriksaan Fisik</a></li>
              <li  class="active"><a href="#tab_3-2" data-toggle="tab">Anamnesis</a></li>
            
              <li class="pull-left header"><i class="fa fa-th"></i> </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_3-2">
               <h3> Anamnesa / Anamnesis</h3>
    
					<div class='row'>
						<div class='col-md-12'>
						
							<?= $form->field($keluhan, 'no_rekmed')->hiddeninput(['value'=>$model->no_rekmed])->label(false) ?>
							<?= $form->field($keluhan, 'model')->hiddeninput(['value'=>$model->iddokter])->label(false) ?>
							<?= $form->field($keluhan, 'kode_p')->hiddeninput(['value'=>$model->idrawat])->label(false) ?>
							
							<?= $form->field($keluhan, 'keluhan')->textarea(['rows' => '6','required'=>true])->label("Keluhan Sekarang")?>
							<?= $form->field($keluhan, 'rwt_penyakits')->textarea(['rows' => '4','required'=>true])->label("Riwayat Penyakit Sekarang")?>
							<?= $form->field($keluhan, 'alergi')->textinput(['placeholder'=>'Kosongkan jika tidak ada'])->label("Alergi") ?>
							
							
						</div>
					</div>
          
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2-2">
                 <h3>Pemeriksaan Fisik</h3>
				  <?= $form->field($rxfisik, 'kesadaran')->dropDownList(ArrayHelper::map(Kesadaran::find()->all(), 'id','kesadaran'))?>
				  <?= $form->field($rxfisik, 'no_rawat')->hiddeninput(['value'=>$model->idrawat])->label(false) ?>
				  <?= $form->field($rxfisik, 'rx_fisik')->textarea(['required'=>true])->label("Pemeriksaan Fisik") ?>
				  <?= $form->field($rxfisik, 'tinggibadan')->textinput(['placeholder'=>'cm']) ?>
				  <?= $form->field($rxfisik, 'beratbadan')->textinput(['placeholder'=>'kg']) ?>
				  <?= $form->field($rxfisik, 'tekanandarah')->textinput(['placeholder'=>'mmHg']) ?>
				  <?= $form->field($rxfisik, 'respirasi')->textinput(['placeholder'=>'Kali/menit']) ?>
				  <?= $form->field($rxfisik, 'suhu')->textinput(['placeholder'=>'Cยบ']) ?>
				  <?= $form->field($rxfisik, 'nadi')->textinput(['placeholder'=>'']) ?>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_1-1">
                 <?= $form->field($model, 'kdiagnosak')->textinput(['placeholder' => 'KODE DIAGNOSA','onkeyup'=>'$.get("'.Url::toRoute('tes/listdiagnosa/').'",{ id: $(this).val() }).done(function( data ) 
									{
										  $( "select#diagnosa-pasien" ).html( data );
										  });']) ?>
               <h3>Diagnosa</h3>
	
				<select id="diagnosa-pasien" class="form-control" name='Rawatjalan[kdiagnosa]' aria-invalid="false">
			
				</select>
				<?= $form->field($model, 'ketdiag')->textarea(['required'=>true]) ?>

              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
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
