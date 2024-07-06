<?php
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use common\models\Articles;
use yii\helpers\Url;
use yii\web\View;
use common\models\StatusHub;
use common\models\Provinsi;
use common\models\Kelurahan;
use common\models\Kabupaten;
use common\models\Kecamatan;
use common\models\Suku;
use common\models\Pendidikan;
use common\models\Jenispekerjaan;
use common\models\Bahasa;
use common\models\Hambatan;
use kartik\date\DatePicker;
$url = 'http://192.168.1.26/simrs/api/alamat';
        $content = file_get_contents($url);
        $json = json_decode($content, true);
        $instArray = ArrayHelper::map($json,'IdKel','Kel');
/* @var $this yii\web\View */
/* @var $model common\models\Pasisen */
/* @var $form yii\widgets\ActiveForm */

?>

<?php $form = ActiveForm::begin(); ?>
<div id='pasien-ajax'>
<div class='container-fluid'>
<div class='box box-danger box-body'>
		<h4>NOMOR REKAMEDIS</h4><hr>
		<div class='row'>
			<div class='col-md-5'>
				<?php ($model->no_rekmed)? $model->no_rekmed : $model->genKode() ?>
				<?php if($pasienonline->no_rekmed == null){ ?>
				<?= $form->field($model, 'no_rekmed')->textInput(['maxlength' => true,'class'=>'hw'])->label(false) ?>
				<?php }else{ ?>
				<?= $form->field($model, 'no_rekmed')->textInput(['maxlength' => true,'class'=>'hw','value'=>$pasienonline->no_rekmed])->label(false) ?>
				<?php } ?>
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
	 <div class="callout callout-success">
                <h2>WAJIB ISI NO BPJS / NIK UNTUK PASIEN YANG MENGGUNAKAN BPJS </h2>
	</div>
	<div class='box box-primary box-body'>
	<h3>Data Pasien</h3><hr>
		<div class='row'>
			<div class='col-md-8'>
				<div class='row'>
					<div class='col-md-2 formright'>No Identitas</div>
					<div class='col-md-10'><?= $form->field($model, 'no_identitas',['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']])->textInput(['value' => $pasienonline->nik],['maxlength' => true])->label(false) ?></div>
				</div>
				<div class='row'>
					<div class='col-md-2 formright'>No BPJS</div>
					<div class='col-md-8'><?= $form->field($model, 'nobpjs',['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']])->textInput(['value' => $pasienonline->nokartu],['maxlength' => true])->label(false) ?></div>
					<div class='col-md-2 '><a id="show-all" class="btn btn-success" ><span class="fa fa-search" style="width: 20px;"></span>Cari</a></div>
				</div>
				<div class='row'>
					<div class='col-md-2 formright'>Nama Pasien</div>
					<div class='col-md-8'><?= $form->field($model, 'nama_pasien',['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']])->textInput(['value' => $pasienonline->nama],['maxlength' => true])->label(false) ?></div>
					<div class='col-md-2'>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" name="Pasien[anggota]" id="lengkap" value="1" class="custom-control-input"  >
					<label class="custom-control-label" for="customCheck1">Anggota</label>
				</div>
					</div>
				</div>
				<div class='row'>
					<div class='col-md-2 formright'>Tempat Lahir</div>
					<div class='col-md-4 formright'><?= $form->field($model, 'tempat_lahir')->textInput(['placeholder' => "Tempat Lahir"],['maxlength' => true])->label(false) ?></div>
					<div class='col-md-2 formright'>Tanggal Lahir</div>
					<div class='col-md-4'>
					<?= $form->field($model, 'tanggal_lahir')->textInput(['value' => $pasienonline->tgllahir],['maxlength' => true])->label(false) ?>
					</div>
				</div>
				<div class='row'>
					<div class='col-md-2 formright'>No HP</div>
					<div class='col-md-10'><?= $form->field($model, 'nohp',['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']])->textInput(['maxlength' => true,'value'=>$pasienonline->nohp])->label(false) ?></div>
				</div>
				
			</div>
			<div class='col-md-4'>
				<div class='row'>
					<div class='col-md-3 formright'>Usia</div>
					<div class='col-md-3'><?= $form->field($model, 'usia')->textInput(['value' => $pasienonline->usia],['maxlength' => true])->label(false) ?></div>
					<div class='col-md-6'>	<?= $form->field($model, 'jenis_kelamin')->textInput(['value' => $pasienonline->jenis_kelamin],['maxlength' => true])->label(false) ?></div>
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
				<div class='row'>
					<div class='col-md-3 formright'>Bahasa</div>
					<div class='col-md-9'><?= $form->field($model, 'idbahasa')->dropDownList(ArrayHelper::map(Bahasa::find()->all(), 'id', 'bahasa') ,['prompt' => 'Pilih Bahasa'])->label(false)?></div>
					
				</div>
				
			</div>
		</div><hr>
		<h3>Hambatan Komunikasi</h3><hr>
			<div class='row'>
			<div class='col-md-1'></div>
			<div class='col-md-7'>
			
			<div class='row'>
					<div class='col-md-3 formright'>Hambatan Komunikasi</div>
					<div class='col-md-9'><?= $form->field($model, 'idhambatan')->dropDownList(ArrayHelper::map(Hambatan::find()->all(), 'id', 'jenishambatan') ,['prompt' => 'Hambatan Komunikasi'])->label(false)?></div>
					
				
					<div class='col-md-3 formright'>Keterangan </div>
					<div class='col-md-9'><?= $form->field($model, 'kethambatan')->textarea(['rows' => 3])->label(false) ?></div>
					
				</div>
			<div class='col-md-4'>
				
			</div>
			</div>
		</div>
		<h3>Data Alamat</h3><hr>
		<div class='row'>
			<div class='col-md-1'></div>
			<div class='col-md-5'>
			
			<div class='row'>
					<div class='col-md-3 formright'>Kelurahan</div>
					<div class='col-md-9'>
					<?= $form->field($model, 'idkel')->widget(Select2::classname(), [
						'data' => $instArray,
						'language' => 'en',
						'options' => [

						'placeholder' => 'Pilih Kelurahan'],
						'pluginOptions' => [
						'allowClear' => true
							
						],
					])->label(false);?>
					</div>
				</div>
				<div class='row'>
					<div class='col-md-3 formright'>Alamat</div>
					<div class='col-md-9'>
					 <?= $form->field($model, 'alamat')->textarea(['rows' => 5])->label(false) ?>
					</div>
				</div>
				<div class='row'>
					<div class='col-md-3 formright'></div>
					<div class='col-md-7'>
					<?= \inquid\signature\SignatureWidget::widget(['clear' => true, 'undo' => true, 'width'=>'300', 'height'=>'200' ,'change_color' => true, 'url' => 'google.com', 'save_jpg' => true]) ?>

					</div>
				</div>
				<div class='row'>
					<div class='col-md-3 formright'>Kode Pos</div>
					<div class='col-md-9 formright'>
					<?= $form->field($model, 'kodepos')->textInput(['maxlength' => true])->label(false) ?>
					</div>
				</div>
			</div>
			<div class='col-md-6'>
				
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
					<?= $form->field($model, 'subid')->dropDownList(['Mil'=>'Mil','Sipil' => 'Sipil', 'Keluarga' => 'Keluarga',], ['prompt' => 'Sebagai'])->label(false) ?>
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
</div>
<?php ActiveForm::end(); ?>
<?php 
$urlShowAll = Url::to(['pasien/show-all']);
$this->registerJs("
	
	$('#show-all').on('click',function(){
	
			nobpjs = $('#pasien-nobpjs').val();
			nama = $('#pasien-nama_pasien').val();
			
			$.ajax({
				type: 'GET',
				url: '{$urlShowAll}',
				data: 'id='+nobpjs,
				success: function (data) {
					if(nobpjs == ''){
					
					alert('isi nomer bpjs');
					$('body,html').animate({ scrollTop: 0 }, 200);
					$('#pasien-ajax').html(data);
					
					
					}else if(nama == ''){
						
					alert('data tidak di temukan');
					$('body,html').animate({ scrollTop: 0 }, 200);
					$('#pasien-ajax').html(data);
					}else{
					
					$('#pasien-ajax').html(data);
					
					console.log(data);
					}
				},
			});
		
	});

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

