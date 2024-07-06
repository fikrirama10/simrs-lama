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
$this->title = 'Pasien BPJS';
$lahir = date('Y-m-d',strtotime($kelas['tglLahir']));
$sekarang = date('Y-m-d');
$diff =strtotime($sekarang)-strtotime($lahir); 
$hari = $diff/86400;
$tahun = floor($hari / 365);
?>
<div class='container-fluid'>

	<div class='box box-body'>
	<h4>Cari Pasien Bpjs Disini</h4>
			<form action="<?= Url::to(['pasien/pesertabpjs/']) ?>" method="get">

 <input type="text" class='form-control' name="id" placeholder="No Kartu"></input><br/>
 <input type="submit" class='btn btn-warning' value="Cari"></input>
</form><hr>
	
		<?php if($kelas == null){?>
			<?php }else{  ?>
			<h4>Data Pasien BPJS</h4><hr>
		<div class='row'>
			
			<div class='col-md-12'>
			<div class='box-body bg-green'>
				<table>
					<tr>
					<td width='120'>No Kartu Peserta</td>
					<td width='50'> : </td>
					<td><?= $kelas['noKartu']?></td>
					</tr>
					<tr>
					<td width='100'>NIK</td>
					<td width='50'> : </td>
					<td><?= $kelas['nik']?></td>
					</tr>
					<tr>
					<td width='100'>Nama</td>
					<td width='50'> : </td>
					<td><?= $kelas['nama']?></td>
					</tr>
					<tr>
					<td width='100'>No Telepon</td>
					<td width='50'> : </td>
					<td><?= $kelas['mr']['noTelepon']?></td>
					</tr>
					<tr>
					<td width='100'>Tanggal Lahir</td>
					<td width='50'> : </td>
					<td><?= date('d F Y',strtotime($kelas['tglLahir']))?></td>
					</tr>
					<tr>
					<td width='100'>Usia</td>
					<td width='50'> : </td>
					<td><?= $tahun?> th</td>
					</tr>
					<tr>
					<td width='100'>Usia</td>
					<td width='50'> : </td>
					<td><?= $kelas['sex']?></td>
					</tr>
					<tr>
					<td width='100'>Kelas Pelayanan</td>
					<td width='50'> : </td>
					<td><?= $kelas['hakKelas']['keterangan']?></td>
					</tr>
					<tr>
					<td width='100'>Jenis Peserta</td>
					<td width='50'> : </td>
					<td><?= $kelas['jenisPeserta']['keterangan']?></td>
					</tr>
				</table>
			</div>
			
			</div>
			<div class='col-md-8'>
				<?php $form = ActiveForm::begin(); ?>
				<?= $form->field($model, 'sbb')->dropDownList([ 'By' => 'By', 'An' => 'An', 'Tn' => 'Tn', 'Ny' => 'Ny', 'Nn' => 'Nn' , ]) ?>
				<?= $form->field($model, 'nobpjs')->hiddenInput(['value'=> $kelas['noKartu']],['maxlength' => true])->label(false) ?>
				<?= $form->field($model, 'no_identitas')->textinput(['value'=> $kelas['nik']],['maxlength' => true])->label(false) ?>
				<?= $form->field($model, 'nama_pasien')->hiddenInput(['value'=> $kelas['nama']],['maxlength' => true])->label(false) ?>
				<?= $form->field($model, 'tanggal_lahir')->hiddenInput(['value'=> $kelas['tglLahir']],['maxlength' => true])->label(false) ?>
				<?= $form->field($model, 'jenis_kelamin')->hiddenInput(['value'=> $kelas['sex']],['maxlength' => true])->label(false) ?>
				<?= $form->field($model, 'usia')->hiddenInput(['value'=> $tahun],['maxlength' => true])->label(false) ?>
					<div class='row'>
						<div class='col-md-3'>
							<?php ($model->no_rekmed)? $model->no_rekmed : $model->genKode() ?>
							<?= $form->field($model, 'no_rekmed')->textInput(['maxlength' => true]) ?>
						</div>
						<div class='col-md-3'>
							<?= $form->field($model, 'nohp')->textInput(['placeholder' => "No Hp"],['maxlength' => true]) ?>
						</div>
						<div class='col-md-3'>
							<?= $form->field($model, 'tempat_lahir')->textInput(['placeholder' => "Tempat Lahir"],['maxlength' => true]) ?>
						</div>
						<div class='col-md-3'>
							<?= $form->field($model, 'kodepos')->textInput(['maxlength' => true]) ?>
						</div>
						
					</div>
					<div class='row'>
						<div class='col-md-3'>
							<?= $form->field($model, 'gol_darah')->dropDownList([ '-'=>'','O' => 'O', 'B' => 'B', 'A' => 'A', 'AB' => 'AB', ], ['prompt' => 'Golongan Darah']) ?>
						</div>
						<div class='col-md-3'>
							<?= $form->field($model, 'agama')->dropDownList([ 'Islam' => 'Islam', 'Khatolik' => 'Khatolik', 'Protestan' => 'Protestan', 'Hindu' => 'Hindu', 'Budha' => 'Budha' ,'Kong Hu Cu' => 'Kong Hu Cu', ]) ?>
						</div>
						<div class='col-md-3'>
							<?= $form->field($model, 'id_status')->dropDownList(ArrayHelper::map(StatusHub::find()->all(), 'id', 'status_hub'))?>
						</div>
						<div class='col-md-3'>
							<?= $form->field($model, 'idpekerjaan')->dropDownList(ArrayHelper::map(Jenispekerjaan::find()->all(), 'id', 'jenis'))?>
						</div>
					<div class='col-md-3'>
						<label id='pangkat'>pangkat</label>
						 <?= $form->field($pekerjaan, 'pangkat')->textInput(['maxlength' => true])->label(false) ?>
					</div>
					
						<div class='col-md-3'>
							<label id='nrp'> NRP </label>
							 <?= $form->field($pekerjaan, 'nrp')->textInput(['maxlength' => true])->label(false) ?>
						</div>
					
						<div class='col-md-3'>
							<label id='kesatuan'> Kesatuan </label>
							 <?= $form->field($pekerjaan, 'kesatuan')->textInput(['maxlength' => true])->label(false) ?>
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
				<?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
					
				<?php ActiveForm::end(); ?>
				<?php } ?>
			</div>
							
			</div>
		</div>
	</div>
</div>