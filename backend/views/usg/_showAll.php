<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\Dokter;
use yii\web\View;
use common\models\Poli;
use common\models\Kamar;
use yii\bootstrap\Modal;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model common\models\Gagalfoto */
/*
 @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<div class='box box-body'>
		<div class='row'>
				<div class='col-md-3 formright'>No RM</div>
				<div class='col-md-3'><?= $form->field($model, 'no_rekmed')->textInput(['maxlength' => true,'value'=>$kelas['no_rekmed']])->label(false) ?>
				</div>
				<div class='col-md-3'>
					<div class="col-sm-1 float-left">
							<div class="form-group">
								<div class='col-md-2 '><a id="show-all" class="btn btn-success" ><span class="fa fa-search" style="width: 20px;"></span>Cari</a></div>
							</div>
						</div>
				</div>
		</div>
		<div class='row'>
				<div class='col-md-3 formright'>Nama Pasien</div>
				<div class='col-md-3'>
				<?= $form->field($model, 'nama')->textInput(['maxlength' => true,'value'=>$kelas['nama']])->label(false) ?>
				</div>
		</div>
		<div class='row'>
		<div class='col-md-3 formright'> </div>
		<div class='col-md-2'>
		<?= $form->field($model, 'jenis_kelamin')->textInput(['maxlength' => true,'value'=>$kelas['jenis_kelamin']])->label('jenis_kelamin') ?>
        </div>
		<div class='col-md-2'>
		<?= $form->field($model, 'usia')->textInput(['maxlength' => true,'value'=>$kelas['usia']])->label('usia') ?>
        </div>
		<div class='col-md-2'>
		<?= $form->field($model, 'alamat')->textarea(['maxlength' => true,'value'=>$kelas['alamat']])->label('alamat') ?>
        </div>
		
		</div>

		<div class='row'>
			<div class='col-md-3 formright'>Status Pasien</div>
				<div class='col-md-5'>
						<?= $form->field($model, 'stpasien')->dropDownList([ 'RS' => 'RS', 'Luar' => 'Luar', ], ['prompt' => 'Jenis Pasien'])->label(false) ?>
				</div>
			</div>
			<div class='row' id='dluar'>
			<div class='col-md-3 formright'>Dokter Luar</div>
				<div class='col-md-5'>
					<?= $form->field($model, 'dl')->textinput(['maxlength' => true,])->label(false) ?>
				</div>
			</div>
	<div class='row' id='drs'>
			<div class='col-md-3 formright'>Dokter RS</div>
				<div class='col-md-5'>
					<?= $form->field($model, 'dokter')->dropDownList(ArrayHelper::map(Dokter::find()->all(), 'namadokter', 'namadokter'),['prompt'=>'- Pilih Dokter -'])->label(false)?>
				</div>
			</div>
		<div class='row'>
			<div class='col-md-3 formright'>Tgl USG</div>
				<div class='col-md-3'>
				<?=	$form->field($model, 'tglusg')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label(false)?>
				</div>
			</div>
		
		</div>
		
	
	 <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>



<?php 
$urlShowAll = Url::to(['usg/show-all']);
$this->registerJs("
			
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

