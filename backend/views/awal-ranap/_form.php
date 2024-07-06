<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\View;
use yii\web\JsExpression;
$formatJs = <<< 'JS'
var formatRepo = function (repo) {
    if (repo.loading) {
        return repo.text;
		
    }
    var marckup =repo.nama;   
    return marckup ;
};
var formatRepoSelection = function (repo) {
    return repo.nama || repo.text;
}
JS;
 
// Register the formatting script
$this->registerJs($formatJs, View::POS_HEAD);
 
// script to parse the results into the format expected by Select2
$resultsJs = <<< JS
function (data) {    
    return {
        results: data,
        
    };
}
JS;
?>
<div class='box'>
	
	<div class='box-body'>
			
			<div class='col-md-6'>
				<h5>Detail Pasien</h5>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Nama Pasien</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->pasien->sbb ?>.<?= $rajal->pasien->nama_pasien ?> ,(<?= $rajal->pasien->usia ?> th)'>
					
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Tanggal Lahir</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->pasien->tanggal_lahir ?>'>
					<span class="input-group-addon" id="basic-addon1">Alamat</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->pasien->alamat ?>'>
					
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Tanggal Masuk</span>
					<input type='text' class='form-control' readonly value='<?= date('Y/m/d',strtotime($rajal->tglmasuk)) ?>  '>
					
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Ruangan</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->kamar->namaruangan?>'>
					<span class="input-group-addon" id="basic-addon1">Penjamin</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->carabayar->jenisbayar?>'>
					
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">DPJP</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->dokter->namadokter?>'>
					
				</div>
				
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Nomor RM</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->no_rekmed ?>'>
						<span class="input-group-addon" id="basic-addon1">Nomer Register</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->idrawat ?>'>
				</div>
				<hr>
			

				
				
				</div>
				<div class='col-md-6'>
				<?php $form = ActiveForm::begin(); ?>
					<h5>Pemeriksaan Pasien Rawat Inap</h5>
				<?= $form->field($model, 'anamnesa')->textarea(['rows'=>4])->label('Anamnesa Pasien Masuk')  ?>
				<?= $form->field($model, 'kesadaran')->textarea(['rows'=>2])->label('Kesadaran Pasien')  ?>
				<?= $form->field($model, 'fisik')->textarea(['rows'=>2])->label('Keadaan Umum Pasien')  ?>
								<div class='row'>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' placeholder='Tekanan Darah' name='PemeriksaanawalRanap[td]' id="pemeriksaanawalranap-td"><span class="input-group-addon" id="basic-addon1">mmHg</span>
						</div>
					</div>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' placeholder='Nadi' name='PemeriksaanawalRanap[nadi]' id="pemeriksaanawalranap-nadi"><span class="input-group-addon" id="basic-addon1">x / menit</span>
						</div>
					</div>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' placeholder='Respirasi' name='PemeriksaanawalRanap[respirasi]' id="pemeriksaanawalranap-respirasi"><span class="input-group-addon" id="basic-addon1">x / menit</span>
						</div>
					</div>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' placeholder='Suhu' name='PemeriksaanawalRanap[suhu]' id="pemeriksaanawalranap-suhu"><span class="input-group-addon" id="basic-addon1">C</span>
						</div>
					</div>
				</div>
				
				<?= $form->field($model, 'diagnosa_awal')->widget(Select2::classname(), [
					'name' => 'kv-repo-template',
					'options' => ['placeholder' => 'Cari Diagnosa .....'],
					'pluginOptions' => [
					'allowClear' => true,
					'minimumInputLength' => 3,
					'ajax' => [
					'url' => "https://simrs.rsausulaiman.com/apites/listdiagnosa",
					'dataType' => 'json',
					'delay' => 250,
					'data' => new JsExpression('function(params) { return {q:params.term};}'),
					'processResults' => new JsExpression($resultsJs),
					'cache' => true
					],
					'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
					'templateResult' => new JsExpression('formatRepo'),
					'templateSelection' => new JsExpression('formatRepoSelection'),
					],
				])->label('diagnosa awal');?>	
				<?= $form->field($model, 'jam_masuk')->widget(TimePicker::classname(), ['pluginOptions' => [
						'showSeconds' => false,
						'showMeridian' => false,
						'minuteStep' => 1,
						'secondStep' => 5,
					]])->label('Jam Masuk'); ?>
					<div class="form-group">
					<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
				</div>
			 <?php ActiveForm::end(); ?>
				
				</div>


</div>
</div>

