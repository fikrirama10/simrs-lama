<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\Articles;
use yii\web\View;
use common\models\StatusHub;
use common\models\Provinsi;
use common\models\Kelurahan;
use common\models\Kabupaten;
use common\models\Kecamatan;
use common\models\Suku;
use common\models\Pendidikan;
use common\models\Jenispekerjaan;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Pasisen */
/* @var $form yii\widgets\ActiveForm */

?>
<?php $form = ActiveForm::begin(); ?>
<div class='container-fluid'>
<div class='box box-danger box-body'>
		<h4>NOMOR REKAMEDIS</h4><hr>
		<div class='row'>
			<div class='col-md-5'>
				<?php ($model->no_rekmed)? $model->no_rekmed : $model->genKode() ?>
				<?= $form->field($model, 'no_rekmed')->textInput(['maxlength' => true,'class'=>'hw'])->label(false) ?>
			</div>
			<div class='col-md-7'>
			<?php $a = Articles::findOne(91); ?>
				<div class='alert alert-warning'>
				<h4><?= $a->Title ?></h4>
				<p><?= $a->SubTitle?></p>
				<?= $a->Content?>
				</div>
			</div>
		</div>
	</div>
	<div class='box box-primary box-body'>
	<h3>Data Pasien</h3><hr>
		<div class='row'>
			<div class='col-md-8'>
				<div class='row'>
					<div class='col-md-2 formright'>No Identitas</div>
					<div class='col-md-10'><?= $form->field($model, 'no_identitas',['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']])->textInput(['placeholder' => "No identitas"],['maxlength' => true])->label(false) ?></div>
				</div>
				<div class='row'>
					<div class='col-md-2 formright'>No BPJS</div>
					<div class='col-md-10'><?= $form->field($model, 'nobpjs',['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']])->textInput(['placeholder' => "Di isi jika pasien bpjs daftar secara manual"],['maxlength' => true])->label(false) ?></div>
				</div>
				<div class='row'>
					<div class='col-md-2 formright'>Nama Pasien</div>
					<div class='col-md-3 formright'><?= $form->field($model, 'sbb')->dropDownList([ 'By' => 'By', 'An' => 'An', 'Tn' => 'Tn', 'Ny' => 'Ny', 'Nn' => 'Nn' , ])->label(false) ?></div>
					<div class='col-md-7'><?= $form->field($model, 'nama_pasien',['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']])->textInput(['placeholder' => "Nama Pasien"],['maxlength' => true])->label(false) ?></div>
				</div>
				<div class='row'>
					<div class='col-md-2 formright'>Tempat Lahir</div>
					<div class='col-md-4 formright'><?= $form->field($model, 'tempat_lahir')->textInput(['placeholder' => "Tempat Lahir"],['maxlength' => true])->label(false) ?></div>
					<div class='col-md-2 formright'>Tanggal Lahir</div>
					<div class='col-md-4'><?=	$form->field($model, 'tanggal_lahir')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label(false)?></div>
				</div>
				<div class='row'>
					<div class='col-md-2 formright'>No HP</div>
					<div class='col-md-10'><?= $form->field($model, 'nohp',['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']])->textInput(['maxlength' => true])->label(false) ?></div>
				</div>
			</div>
			<div class='col-md-4'>
				<div class='row'>
					<div class='col-md-3 formright'>Usia</div>
					<div class='col-md-3'><?= $form->field($model, 'usia')->textInput(['placeholder' => "Usia"],['maxlength' => true])->label(false) ?></div>
					<div class='col-md-6'>	<?= $form->field($model, 'jenis_kelamin')->dropDownList([ 'L' => 'L', 'P' => 'P', ], ['prompt' => 'Jenis Kelamin'])->label(false) ?></div>
				</div>
				<div class='row'>
					<div class='col-md-3 formright'>Agama</div>
					<div class='col-md-9'><?= $form->field($model, 'agama')->dropDownList([ 'Islam' => 'Islam', 'Khatolik' => 'Khatolik', 'Protestan' => 'Protestan', 'Hindu' => 'Hindu', 'Budha' => 'Budha' ,'Kong Hu Cu' => 'Kong Hu Cu', ])->label(false) ?></div>
					
				</div>
				<div class='row'>
				<div class='col-md-3 formright'>GOl Darah</div>
				<div class='col-md-3'><?= $form->field($model, 'gol_darah')->dropDownList([ '-'=>'','O' => 'O', 'B' => 'B', 'A' => 'A', 'AB' => 'AB', ], ['prompt' => 'GD'])->label(false) ?></div>
					
					<div class='col-md-6'><?= $form->field($model, 'id_status')->dropDownList(ArrayHelper::map(StatusHub::find()->all(), 'id', 'status_hub') ,['prompt' => 'Status'])->label(false)?></div>
					
					
				</div>
				<div class='row'>
					<div class='col-md-3 formright'>Suku</div>
					<div class='col-md-9'><?= $form->field($model, 'suku')->dropDownList(ArrayHelper::map(Suku::find()->all(), 'id', 'suku') ,['prompt' => 'Pilih Suku'])->label(false)?></div>
					
				</div>
				<div class='row'>
					<div class='col-md-3 formright'>Pendidikan</div>
					<div class='col-md-9'><?= $form->field($model, 'pendidikan')->dropDownList(ArrayHelper::map(Pendidikan::find()->all(), 'id', 'pendidikan') ,['prompt' => 'Pilih Pendidikan'])->label(false)?></div>
					
				</div>
			</div>
		</div><hr>
		<h3>Data Alamat</h3><hr>
		<div class='row'>
			<div class='col-md-1'></div>
			<div class='col-md-5'>
				<div class='row'>
					<div class='col-md-3 formright'>Provinsi</div>
					<div class='col-md-9 formright'>
					<?= $form->field($model,'idprov')->dropDownList(ArrayHelper::map(Provinsi::find()->all(),'id_prov','nama'),[
						'prompt'=>'- Pilih Provinsi -',
						'onchange'=>'$.get("'.Url::toRoute('pasien/list/').'",{ id: $(this).val() }).done(function( data ) 
							{
								  $( "select#pasien-idkab" ).html( data );
								});
							'
						])->label(false);?>
					</div>
				</div>
				<div class='row'>
					<div class='col-md-3 formright'>Kabupaten</div>
					<div class='col-md-9 formright'>
					<?= $form->field($model, 'idkab')->dropDownList(ArrayHelper::map(Kabupaten::find()->where(['id_kab'=>0])->all(), 'id_kab', 'nama'),['prompt'=>'- Pilih Kabupaten / Kota -','onchange'=>'$.get("'.Url::toRoute('pasien/listkec/').'",{ id: $(this).val() }).done(function( data ) 
							{
								  $( "select#pasien-idkec" ).html( data );
								});
							'])->label(false)?>
					</div>
				</div>
				<div class='row'>
					<div class='col-md-3 formright'>Kabupaten</div>
					<div class='col-md-9 formright'>
					<?= $form->field($model, 'idkec')->dropDownList(ArrayHelper::map(Kecamatan::find()->where(['id_kec'=>0])->all(), 'id_kec', 'Kecamatan'),['prompt'=>'- Pilih Kecamatan -','onchange'=>'$.get("'.Url::toRoute('pasien/listkel/').'",{ id: $(this).val() }).done(function( data ) 
							{
								  $( "select#pasien-idkel" ).html( data );
								});
							'])->label(false)?>
					</div>
				</div>
			<div class='row'>
					<div class='col-md-3 formright'>Kelurahan</div>
					<div class='col-md-9 formright'>
					<?= $form->field($model, 'idkel')->dropDownList(ArrayHelper::map(Kelurahan::find()->where(['id_kel'=>0])->all(), 'id_kel', 'Kelurahan'),['prompt'=>'- Pilih Kelurahan -'])->label(false)?>
					</div>
				</div>
			</div>
			<div class='col-md-6'>
				<div class='row'>
					
					<div class='col-md-8'>
					 <?= $form->field($model, 'alamat')->textarea(['rows' => 5])->label('Alamat Lengkap') ?>
					</div>
				</div>
				<div class='row'>
					<div class='col-md-2 formright'>Kode Pos</div>
					<div class='col-md-6 formright'>
					<?= $form->field($model, 'kodepos')->textInput(['maxlength' => true])->label(false) ?>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<h3>Data Pekerjaan</h3><hr>
		<div class='row'>
			<div class='col-md-10'>
			<div class='row'>
				<div class='col-md-3 formright'>Jenis Pekerjaan</div>
					<div class='col-md-9 formright'>
					 <?= $form->field($pekerjaan, 'idjenis')->dropDownList(ArrayHelper::map(Jenispekerjaan::find()->all(), 'id', 'jenis'),['prompt'=>'- Pilih Pekerjaan -'])->label(false)?>
					</div>
				</div>
				<div class='row' id='tni'>
				<div class='col-md-3 formright'>Sebagai</div>
					<div class='col-md-9 formright'>
					<?= $form->field($model, 'subid')->dropDownList(['Mil'=>'Mil','Sip' => 'Sip', 'Kel' => 'Kel', ], ['prompt' => 'Sebagai'])->label(false) ?>
					</div>
					<div class='col-md-3 formright'>Pangkat</div>
					<div class='col-md-9 formright'>
					 <?= $form->field($pekerjaan, 'pangkat')->textInput(['maxlength' => true])->label(false) ?>
					</div>
					<div class='col-md-3 formright'>NRP</div>
					<div class='col-md-9 formright'>
					 <?= $form->field($pekerjaan, 'nrp')->textInput(['maxlength' => true])->label(false) ?>
					</div>
					<div class='col-md-3 formright'>Kesatuan</div>
					<div class='col-md-9 formright'>
					 <?= $form->field($pekerjaan, 'kesatuan')->textInput(['maxlength' => true])->label(false) ?>
					</div>
					<input type='hidden' id='coba' name='coba'>
				</div>
			</div>
		</div>
		<div class='box box-footer'>
		<div class="form-grup pull-right">
						<?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg']) ?>
					</div>
	</div>
	</div>
	
	
</div>
<?php ActiveForm::end(); ?>
<?php 
$this->registerJs("

            $('#pasien-tanggal_lahir').on('change',function() {
                var dob = new Date(this.value);
                var today = new Date();
                var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
                $('#pasien-usia').val(age);
            });
				$('#tni').addClass('disabel');
				
		
				$('#pekerjaan-idjenis').on('change',function() {
				
                var dob = $('#pekerjaan-idjenis').val();
				$('#coba').val(dob);
				if(dob < 5){
				$('#tni').removeClass('disabel');
				
				}else{
				$('#tni').addClass('disabel');
				}
				});
        
	

", View::POS_READY);
?>

