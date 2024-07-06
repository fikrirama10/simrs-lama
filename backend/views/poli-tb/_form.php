<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $model common\models\Tb */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-form">
	<div class='box box-body'>
	<?php $form = ActiveForm::begin(); ?>
	<div id='pasien-ajax'>


		<div class='row'>
				<div class='col-md-2 formright'>No RM</div>
				<div class='col-md-2'><?= $form->field($model, 'no_rm')->textInput(['maxlength' => true])->label(false) ?>
				</div>
				<div class='col-md-2'>
					<div class="col-sm-1 float-left">
							<div class="form-group">
								<div class='col-md-2 '><a id="show-all" class="btn btn-success" ><span class="fa fa-search" style="width: 20px;"></span>Cari</a></div>
							</div>
						</div>
				</div>
		</div>
		<div class='row'>
				<div class='col-md-2 formright'>NIK</div>
				<div class='col-md-3'>
				<?= $form->field($model, 'ktp')->textInput(['maxlength' => true])->label(false) ?>
				</div>
		</div>
		<div class='row'>
				<div class='col-md-2 formright'>BPJS</div>
				<div class='col-md-3'>
				<?= $form->field($model, 'bpjs')->textInput(['maxlength' => true])->label(false) ?>
				</div>
		</div>
		<div class='row'>
				<div class='col-md-2 formright'>Nama Pasien</div>
				<div class='col-md-3'>
				<?= $form->field($model, 'nama')->textInput(['maxlength' => true])->label(false) ?>
				</div>
		</div>
		<div class='row'>
				<div class='col-md-2 formright'>Tanggal Lahir</div>
				<div class='col-md-3'>
				<?= $form->field($model, 'tgl_lahir')->textInput(['maxlength' => true])->label(false) ?>
				</div>
		</div>
		<div class='row'>
				<div class='col-md-2 formright'>No HP</div>
				<div class='col-md-3'>
				<?= $form->field($model, 'no_hp')->textInput(['maxlength' => true])->label(false) ?>
				</div>
		</div>
		
		<div class='row'>
			<div class='col-md-2 formright'></div>
			<div class='col-md-2'>
				<?= $form->field($model, 'jenis_kelamin')->textInput(['maxlength' => true,])->label('jenis_kelamin') ?>
			</div>
			<div class='col-md-1'>
				<?= $form->field($model, 'usia')->textInput(['maxlength' => true])->label('usia') ?>
			</div>
		</div>
		<div class='row'>
				<div class='col-md-2 formright'>Alamat</div>
				<div class='col-md-3'>
				<?= $form->field($model, 'alamat')->textarea(['maxlength' => true,'rows'=>6])->label(false) ?>
				</div>
		</div>
		<div class='row'>
			<div class='col-md-2 formright'></div>
			<div class='col-md-1'>
				 <?= $form->field($model, 'berat_badan')->textInput(['maxlength' => true]) ?>
			</div>
			<div class='col-md-1'>
				 <?= $form->field($model, 'tinggi_badan')->textInput(['maxlength' => true]) ?>
			</div>
		</div>
		<div class='row'>
				<div class='col-md-2 formright'>Jenis Pasien</div>
				<div class='col-md-3'>
				 <?= $form->field($model, 'jenis_pasien')->dropDownList([ 'Anggota' => 'Anggota', 'Umum' => 'Umum', ], ['prompt' => ''])->label(false) ?>
				</div>
		</div>

		<div class="form-group">
			<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
		</div>

		
		</div>
		<?php ActiveForm::end(); ?>
		</div>
</div>
<?php 
$urlShowAll = Url::to(['poli-tb/show-all']);
$this->registerJs("
			$('#show-all').on('click',function(){
			nobpjs = $('#tb-no_rm').val();
			$.ajax({
				type: 'GET',
				url: '{$urlShowAll}',
				data: 'id='+nobpjs,
				success: function (data) {
						$('#pasien-ajax').html(data);
					
					console.log(data);
				},
			});
		
	});
					$('#dluar').addClass('disabel');
					$('#drs').addClass('disabel');
				
		
				$('#usg-stpasien').on('change',function() {
				
                var dob = $('#usg-stpasien').val();
				$('#coba').val(dob);
				if(dob == 'RS'){
				$('#drs').removeClass('disabel');
				$('#dluar').addClass('disabel');
				}else if(dob == 'Luar'){
				$('#dluar').removeClass('disabel');
				$('#drs').addClass('disabel');
				}else{
					$('#dluar').addClass('disabel');
					$('#drs').addClass('disabel');
				}
				});
        
	

", View::POS_READY);
?>

