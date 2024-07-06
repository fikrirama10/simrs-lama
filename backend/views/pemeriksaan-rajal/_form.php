<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Kesadaran;
use common\models\Tindakan;
use common\models\KategoriTindakan;
use common\models\KategoriPenyakitMulut;
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
/* @var $model common\models\PemeriksaanRajal */
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
					<input type='text' class='form-control' readonly value='<?= $rajal->polii->namapoli?>'>
					<span class="input-group-addon" id="basic-addon1">Penjamin</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->carabayar->jenisbayar?>'>
					
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Nama Dokter</span>
					<input type='text' class='form-control' readonly value='<?= $rajal->dokter->namadokter?>'>
					
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
				<?php if($rajal->idkb == 2){ ?>
				<h5>Anamnesa</h5>
				<?php }else{ ?>
				<h5>Anamnesa</h5>
				<?php }?>
				<textarea type='text' id="PemeriksaanRajal-pemeriksaan" class='form-control' placeholder='Pemeriksa Dokter' rows='6' name='PemeriksaanRajal[pemeriksaan]'></textarea>	
				<hr>
								
			</div>
			<div class='col-md-6'>
				
				<h5>Terapi & Tindakan</h5>
				<?php if($rajal->idpoli == 1){ ?>
                <?= $form->field($model, 'katgigi')->dropDownList(ArrayHelper::map(KategoriTindakan::find()->all(), 'id', 'kategori'),['prompt'=>'- Pilih Pengobatan -','onchange'=>'$.get("'.Url::toRoute('pemeriksaan-rajal/list-pengobatan/').'",{ id: $(this).val() }).done(function( data ) 
								{
									  $( "select#pemeriksaanrajal-katpenyakitmulut" ).html( data );
									});
							
								'])->label('Golongan',['class'=>'label-class'])?>
				<?= $form->field($model, 'katpenyakitmulut')->dropDownList(ArrayHelper::map(Tindakan::find()->where(['id'=>0])->all(), 'id', 'namatindakan'),['prompt'=>'- Macam Pengobatan-'])->label('Macam Pengobatan',['class'=>'label-class'])?>
				<?= $form->field($model, 'macampenyakitmulut')->dropDownList(ArrayHelper::map(KategoriPenyakitMulut::find()->all(), 'id', 'penyakit'),['prompt'=>'- Kategori Penyakit -'])->label('Kategori Penyakit',['class'=>'label-class'])?>
				<?php } ?>
				<?= $form->field($model, 'tindakandokter')->textarea(['rows'=>6])->label('Tindakan Dokter')  ?>
				<?= $form->field($model, 'resepobat')->textarea(['rows'=>6])->label('Obat / Terapi Dokter')  ?>
				<h5>Pemeriksaan Fisik</h5>
				<div class='row'>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' placeholder='Tekanan Darah' name='PemeriksaanRajal[td]' id="PemeriksaanRajal-td"><span class="input-group-addon" id="basic-addon1">mmHg</span>
						</div>
					</div>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' placeholder='Nadi' name='PemeriksaanRajal[nadi]' id="PemeriksaanRajal-nadi"><span class="input-group-addon" id="basic-addon1">x / menit</span>
						</div>
					</div>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' placeholder='Respirasi' name='PemeriksaanRajal[respirasi]' id="PemeriksaanRajal-respirasi"><span class="input-group-addon" id="basic-addon1">x / menit</span>
						</div>
					</div>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' placeholder='Suhu' name='PemeriksaanRajal[suhu]' id="PemeriksaanRajal-suhu"><span class="input-group-addon" id="basic-addon1">C</span>
						</div>
					</div>
				</div>
				<hr>
				
				<h5>Diagnosa</h5>
				
				<?= $form->field($model, 'diagnosa')->widget(Select2::classname(), [
					'name' => 'kv-repo-template',
					'options' => ['placeholder' => 'Cari Diagnosa .....'],
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

