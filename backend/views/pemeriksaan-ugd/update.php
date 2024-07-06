<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Kesadaran;
use common\models\Dokter;
use common\models\Keadaan;
use common\models\Triage;
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

<div class="pemeriksaan-igd-form">
		<div class='box'>
		<div class='box-body'>
			<?php $form = ActiveForm::begin(); ?>
			<div class='col-md-6'>
		    	<?= $form->field($model, 'iddokter')->dropDownList(ArrayHelper::map(Dokter::find()->where(['idpoli'=>6])->andwhere(['aktif'=>1])->all(), 'id', 'namadokter'),['prompt'=>'- Pilih Dokter -','required'=>true])->label('Dokter',['class'=>'label-class'])->label(false)?>
				<h5>Anamnesa</h5>
				<?= $form->field($model, 'keluhanutama')->textarea(['rows'=>3])->label('Keluhan Utama') ?>
				<?= $form->field($model, 'rwpenyakit')->textarea(['rows'=>3])->label('Riwayat Penyakit') ?>
				
				<hr>
				<h6>Triage</h6>
				<?= $form->field($model, 'triase')->radioList(ArrayHelper::map(Triage::find()->all(), 'id','kategori'))->label(false) ?>
				<h6>Keadaan Umum</h6>
				<?= $form->field($model, 'keadaanumum')->radioList(ArrayHelper::map(Keadaan::find()->all(), 'id','keaddan'))->label(false)?>
				<h6>Kesadaran</h6>
				<?= $form->field($model, 'idkesadaran')->radioList(ArrayHelper::map(Kesadaran::find()->all(), 'id','kesadaran'))->label(false)?>
			
								
			</div>
			<div class='col-md-6'>
			    	<h5>Diagnosa</h5>
				
				<?= $form->field($model, 'diagnosa')->widget(Select2::classname(), [
					'name' => 'kv-repo-template',
					'options' => ['placeholder' => 'Cari Diagnosa .....','required'=>true],
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
				])->label(false);?>		
				<h5>Pemeriksaan Fisik</h5>
				<div class='row'>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' value='<?= $model->td ?>'  placeholder='Tekanan Darah' name='PemeriksaanIgd[td]' id="pemeriksaanigd-td"><span class="input-group-addon" id="basic-addon1">TD mmHg</span>
						</div>
					</div>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' value='<?= $model->nadi ?>' class='form-control' placeholder='Nadi' name='PemeriksaanIgd[nadi]' id="pemeriksaanigd-nadi"><span class="input-group-addon" id="basic-addon1">nadi x / menit</span>
						</div>
					</div>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' value='<?= $model->pernapasan ?>' placeholder='Pernapasan' name='PemeriksaanIgd[pernapasan]' id="pemeriksaanigd-pernapasan"><span class="input-group-addon" id="basic-addon1">Respirasi x / menit</span>
						</div>
					</div>
					<div class='col-md-6'>
						<div class="input-group">
						<input type='text' class='form-control' value='<?= $model->suhu ?>'  placeholder='Suhu' name='PemeriksaanIgd[suhu]' id="pemeriksaanigd-suhu"><span class="input-group-addon" id="basic-addon1">ºC</span>
						</div>
					</div>
				</div>	<br>			
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Kepala</span>
					<textarea type='text' class='form-control' name='PemeriksaanIgd[ku_kepala]' id="pemeriksaanigd-ku_kepala" ><?= $model->ku_kepala ?></textarea>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Leher</span>
					<textarea type='text' class='form-control' name='PemeriksaanIgd[ku_leher]' id="pemeriksaanigd-ku_leher"><?= $model->ku_leher ?></textarea>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Paru paru</span>
					<textarea type='text' class='form-control' name='PemeriksaanIgd[ku_tparu]' id="pemeriksaanigd-ku_tparu"><?= $model->ku_tparu ?></textarea>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Jantung</span>
					<textarea type='text' class='form-control' name='PemeriksaanIgd[ku_tjantung]' id="pemeriksaanigd-ku_tjantung"><?= $model->ku_tjantung ?></textarea>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Abdomen</span>
					<textarea type='text' class='form-control' name='PemeriksaanIgd[abdomen]' id="pemeriksaanigd-abdomen"><?= $model->abdomen ?></textarea>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Kulit</span>
					<textarea type='text' class='form-control' name='PemeriksaanIgd[kulit]' id="pemeriksaanigd-kulit"><?= $model->kulit ?></textarea>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Extremitas</span>
					<textarea type='text' class='form-control' name='PemeriksaanIgd[extremitas]' id="pemeriksaanigd-extremitas"><?= $model->extremitas ?></textarea>
				</div><hr>		
							
			</div>
			
		</div>
		<div class='box box-footer'>
			<div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

		</div>

	</div>
	</div>
    
    <?php ActiveForm::end(); ?>

