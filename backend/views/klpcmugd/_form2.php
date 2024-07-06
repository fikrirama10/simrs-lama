<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\web\JsExpression;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\Dokter;
use yii\web\View;
use common\models\JenisDiagnosa;
use common\models\Poli;
use common\models\Kamar;
use yii\bootstrap\Modal;
use kartik\checkbox\CheckboxX;

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
/* @var $model common\models\Gagalfoto */
/* @var $form yii\widgets\ActiveForm */
?>
<div class='box box-body'>
		<div class='row'>
		
    <?php $form = ActiveForm::begin(); ?>
			<div class='col-md-3 formright'>Tanggal</div>
			<div class='col-md-3'>
					<?= $form->field($model, 'tanggal')->textInput(['maxlength' => true])->label(false) ?>
			</div>
			
		</div>
		<div class='row'>
				<div class='col-md-3 formright'>No RM</div>
				<div class='col-md-3'><?= $form->field($model, 'no_rekmed')->textInput(['maxlength' => true])->label(false) ?>
				</div>
				<div class='col-md-3'>
					<div class="col-sm-1 float-left">
							<div class="form-group">
								<input type="button" class="btn btn-info" value='cari pasien' id='cari'>
							</div>
						</div>
				</div>
		</div>
		<div class='row'>
				<div class='col-md-3 formright'></div>
				<div class='col-md-3'>
				<?= $form->field($model, 'idrajal')->hiddeninput(['maxlength' => true])->label(false) ?>
				</div>
		</div>
		<div class='row'>
			<div class='col-md-3 formright'>Dpjp</div>
				<div class='col-md-3'> <?= $form->field($model, 'dpjp')->dropDownList(ArrayHelper::map(Dokter::find()->all(), 'id', 'namadokter'),['prompt'=>'- Pilih Dokter -'])->label('Dokter',['class'=>'label-class'])->label(false)?>
				</div>
			</div>
		<div class='row'>
		<div class='col-md-3 formright'>Diagnosa </div>
		<div class='col-md-5'>
		<?= $form->field($model, 'icd10')->widget(Select2::classname(), [
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
				
				
		</div>
		
		</div>
		<div class='row'>
		<div class='col-md-3 formright'>Diagnosa Rajal </div>
		<div class='col-md-4'>
		<b><input type='text' class='form-control' readonly id='diagnosa-tampil'></b>
		</div>
		
		</div>
		<div class='row'>
			<div class='col-md-3 formright'>Jenis Penyakit</div>
			<div class='col-md-5'> <?= $form->field($model, 'jenispenyakit')->dropDownList(ArrayHelper::map(JenisDiagnosa::find()->all(), 'id', 'jenisdiagnosa'),['prompt'=>'- Jenis Penyakit -'])->label('',['class'=>'label-class'])->label(false)?>
			</div>
		</div>
		<div class='row'>
			<div class='col-md-3 formright'>Ket Diagnosa</div>
				<div class='col-md-5'> <?= $form->field($model, 'ketdiag')->dropDownList([ 'TB+' => 'TB+','SUSPTB'=>'SUSPTB', 'B20' => 'B20', ], ['prompt' => 'Keterangan Diagnosa'])->label(false) ?>
				</div>
			</div>
			<div class='row'>
			<div class='col-md-3 formright'>Jenis Formulir</div>
				<div class='col-md-5'> <?=	$form->field($model, 'jform[]')->widget(Select2::className(),
								[
									'data'=> common\models\Folmulir::getOptions(),
									'options' => [
										'tags' => true,
										'multiple' => true
									],
								]
							)->label(false);
						?>
				</div>
			</div>
		
		<div class='row'>
			<div class='col-md-3 formright'>Tidak Lengkap</div>
				<div class='col-md-9'>
			 <?=	$form->field($model, 'tdklengkap[]')->widget(Select2::className(),
								[
									'data'=> common\models\Formtdk::getOptions(),
									'options' => [
										'tags' => true,
										'multiple' => true
									],
								]
							)->label(false);
						?>
				</div>
			</div>
			<div class='row'>
			<div class='col-md-3 formright'></div>
				<div class='col-md-3'>
				<?= $form->field($model, 'idpoli')->hiddeninput(['maxlength' => true])->label(false) ?>
				</div>
			</div>
		<div class='row'>
			<div class='col-md-3 formright'>Lengkap</div>
				<div class='col-md-3 form-group'>
					<input type="checkbox"  name="Klpcm[lengkap]" id="lengkap" value="1">
				</div>
			</div>
			<div class='row'>
			    	<div class='col-md-3 formright'>Terbaca ?</div>
				<div class='col-md-3 form-group'>
					<input type="checkbox"  name="Klpcm[keterbacaan]" id="keterbacaan" value="1">
				</div>
			    
			</div>
			
		</div>
	 <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
<?php
$urlShowAll = Url::to(['klpcmugd/get-pasien']);
$databahan = ($model->jform)?$model->jform:'';
$datafinishing= ($model->tdklengkap)?$model->tdklengkap:'';
//$datawarna = ($model->Warna)?$model->Warna:'[""]';
// Modal::begin([
	// 'id' => 'mdTemplate',
	// 'header' => '<h3>Pilih Template</h3>',
	// 'size'=>'modal-lg',
	// 'options'=>[
		// 'data-url'=>'transaksi',
	// ],
// ]);

// echo '<div class="modalContent">'. $this->render('_dataTemplate', ['dataTemplate'=>$dataTemplate, ]).'</div>';
 
// Modal::end();

$this->registerJs("
	
	
	$('#cari').on('click',function(){
		id = $('#klpcm-no_rekmed').val();
			$.ajax({
			type: 'POST',
			url: '{$urlShowAll}',
			data: {id: id},
			dataType: 'json',
			success: function (data) {
				if(data !== null){
					var res = JSON.parse(JSON.stringify(data));
					// $('#transaksidetail-harga_satuan').val(res.harga_jual);
					// $('#transaksidetail-idsatuan').val(res.idsatuan);
					$('#klpcm-idrajal').val(res.id);
					$('#klpcm-tanggal').val(res.tgldaftar);
					$('#diagnosa-tampil').val(res.kdiagnosa);
					// $('#stok').val(res.stok);
					// $('#rawatjalan-kdiagnosak').val(res.diagnosa.nama);
					
					
					
					//$('#transaksidetail-harga-disp').val(format_money(parseInt(harga),''));
					// console.log(kode +' '+ idstok);
				}else{
					alert('data tidak ditemukan');
				}
			},
			error: function (exception) {
				alert(exception);
			}
		});	
	}) ;


", View::POS_READY);
?>



