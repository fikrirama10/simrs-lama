<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Kesadaran;
use common\models\Keadaan;
use common\models\Triage;
use common\models\Dokter;
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
/* @var $this yii\web\View */
/* @var $model common\models\PemeriksaanIgd */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pemeriksaan-igd-form">

		<div class='box-body'>
			<?php $form = ActiveForm::begin(); ?>
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
					<span class="input-group-addon" id="basic-addon1">Tanggal Register</span>
					<input type='text' class='form-control' readonly value='<?= date('Y/m/d',strtotime($rajal->tgldaftar)) ?> ( <?= date('H:i a',strtotime($rajal->tgldaftar))?>) '>
					
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Jenis Rawat</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->jerawat->jenisrawat?>'>
					<span class="input-group-addon" id="basic-addon1">Penjamin</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->carabayar->jenisbayar?>'>
					
				</div>
				
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Nomor RM</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->no_rekmed ?>'>
						<span class="input-group-addon" id="basic-addon1">Nomer Register</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->idrawat ?>'>
				</div>
				<div class="input-group">
				
				</div>
				<hr>
				<h5>Dokter Pemeriksa / Jaga</h5>
				<?= $form->field($model, 'iddokter')->dropDownList(ArrayHelper::map(Dokter::find()->where(['idpoli'=>6])->andwhere(['aktif'=>1])->all(), 'id', 'namadokter'),['prompt'=>'- Pilih Dokter -','required'=>true])->label('Dokter',['class'=>'label-class'])->label(false)?>
				<hr>
				<h5>Anamnesa</h5>
				<textarea type='text' id="pemeriksaanigd-keluhanutama" class='form-control' placeholder='Keluhan Utama' name='PemeriksaanIgd[keluhanutama]'></textarea>	
				<textarea type='text' class='form-control' placeholder='Riwayat Penyakit' name='PemeriksaanIgd[rwpenyakit]' id="pemeriksaanigd-rwpenyakit"></textarea>	
				<hr>
				<h6>Triage</h6>
				<?= $form->field($model, 'triase')->radioList(ArrayHelper::map(Triage::find()->all(), 'id','kategori'))->label(false) ?>
				<h6>Keadaan Umum</h6>
				<?= $form->field($model, 'keadaanumum')->radioList(ArrayHelper::map(Keadaan::find()->all(), 'id','keaddan'))->label(false)?>
				<h6>Kesadaran</h6>
				<?= $form->field($model, 'idkesadaran')->radioList(ArrayHelper::map(Kesadaran::find()->all(), 'id','kesadaran'))->label(false)?>
			
								
			</div>
			<div class='col-md-6'>
				<h5>Pemeriksaan Fisik</h5>
				<div class='row'>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' placeholder='Tekanan Darah' name='PemeriksaanIgd[td]' id="pemeriksaanigd-td"><span class="input-group-addon" id="basic-addon1">mmHg</span>
						</div>
					</div>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' placeholder='Nadi' name='PemeriksaanIgd[nadi]' id="pemeriksaanigd-nadi"><span class="input-group-addon" id="basic-addon1">x / menit</span>
						</div>
					</div>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' placeholder='Pernapasan' name='PemeriksaanIgd[pernapasan]' id="pemeriksaanigd-pernapasan"><span class="input-group-addon" id="basic-addon1">x / menit</span>
						</div>
					</div>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' placeholder='Suhu' name='PemeriksaanIgd[suhu]' id="pemeriksaanigd-suhu"><span class="input-group-addon" id="basic-addon1">Cº</span>
						</div>
					</div>
				</div>	<br>			
				<textarea type='text' class='form-control' placeholder='Kepala' name='PemeriksaanIgd[ku_kepala]' id="pemeriksaanigd-ku_kepala"></textarea>		
				<textarea type='text' class='form-control' placeholder='Leher' name='PemeriksaanIgd[ku_leher]' id="pemeriksaanigd-ku_leher"></textarea>		
				<textarea type='text' class='form-control' placeholder='Paru (Thorax)' name='PemeriksaanIgd[ku_tparu]' id="pemeriksaanigd-ku_tparu"></textarea>		
				<textarea type='text' class='form-control' placeholder='Jantung' name='PemeriksaanIgd[ku_tjantung]' id="pemeriksaanigd-ku_tjantung"></textarea>		
				<textarea type='text' class='form-control' placeholder='Abdomen' name='PemeriksaanIgd[abdomen]' id="pemeriksaanigd-abdomen"></textarea>		
				<textarea type='text' class='form-control' placeholder='Kulit' name='PemeriksaanIgd[kulit]' id="pemeriksaanigd-kulit"></textarea>		
				<textarea type='text' class='form-control' placeholder='Extremitas' name='PemeriksaanIgd[extremitas]' id="pemeriksaanigd-extremitas"></textarea>
				<hr>
				<h5>Diagnosa</h5>
				
				<?= $form->field($model, 'diagnosa')->widget(Select2::classname(), [
					'name' => 'kv-repo-template',
					'options' => ['placeholder' => 'Cari Diagnosa .....','required'=>true],
					'pluginOptions' => [
					'allowClear' => true,
					'minimumInputLength' => 3,
					'ajax' => [
					'url' => "https://new-simrs.rsausulaiman.com/auth/listdiagnosa",
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
				])->label(false);?>		
				<div class="form-group">
					<?= Html::submitButton('Next', ['class' => 'btn btn-success']) ?>
				</div>
			</div>
			
		</div>
		<div class='box box-footer'>
			

		</div>

	</div>
    
    <?php ActiveForm::end(); ?>

