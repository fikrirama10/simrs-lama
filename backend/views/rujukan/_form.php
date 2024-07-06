<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\View;
use yii\bootstrap\Modal;
use common\models\Jenisrawat;
use kartik\time\TimePicker;
use kartik\date\DatePicker;
use kartik\checkbox\CheckboxX;
use dosamigos\ckeditor\CKEditor;
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

var formatPoli = function (repo) {
    if (repo.loading) {
        return repo.text;		
    }
    var marckup =repo.nama;   
    return marckup ;
};

var formatPoliSelection = function (repo) {
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

<div class="ert-form">

    <?php $form = ActiveForm::begin(); ?>
	<div class='box box-body'>
	<div class='row'>
		<div class='col-md-2 formright'>NO RM</div>
		<div class='col-md-3'><?= $form->field($model, 'no_rekmed')->textinput()->label(false) ?>
		</div>
		
		<div class="col-sm-2 float-left">
						
		<div class="col-sm-1 float-left">
							<div class="form-group">
								<button type="button" class="btn btn-info" data-toggle="modal" data-target="#mdTemplate"><i class='fa fa-search'></i>Pasien</button><br>
							</div>
						</div>
		</div>
		</div>
		<div class='row'>
		<div class='col-md-2 formright'>Nama Pasien </div>
		<div class='col-md-3'><?= $form->field($model, 'nama')->textinput()->label(false) ?></div>
		<div class='col-md-1 formright'>Usia</div>
				<div class='col-md-2'><?= $form->field($model, 'usia')->textinput()->label(false) ?></div>
				<div class='col-md-1 formright'>JK</div>
				<div class='col-md-1'> <?= $form->field($model, 'jk')->dropDownList([ 'L' => 'L', 'P' => 'P', ], ['prompt' => ''])->label(false) ?></div>
		</div>
		<div class='row'>
		<div class='col-md-2 formright'>Dari </div>
		<div class='col-md-2'><?= $form->field($model, 'asal')->textinput()->label(false) ?></div>
		<div class='col-md-1 formright'>ke</div>
		<div class='col-md-3'>
		<?= $form->field($model, 'ke')->widget(Select2::classname(), [
					'name' => 'kv-repo-template',
					'options' => ['placeholder' => 'Pilih Faskes'],
					'pluginOptions' => [
					'allowClear' => true,
					'minimumInputLength' => 3,
					'ajax' => [
					'url' => "https://simrs.rsausulaiman.com/apites/list-faskes",
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
		<div class='col-md-2'><?= $form->field($model, 'poli')->widget(Select2::classname(), [
					'name' => 'kv-repo-template',
					'options' => ['placeholder' => 'Pilih Poli'],
					'pluginOptions' => [
					'allowClear' => true,
					'minimumInputLength' => 3,
					'ajax' => [
					'url' => "https://simrs.rsausulaiman.com/apites/list-poli",
					'dataType' => 'json',
					'delay' => 250,
					'data' => new JsExpression('function(params) { return {q:params.term};}'),
					'processResults' => new JsExpression($resultsJs),
					'cache' => true
					],
					'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
					'templateResult' => new JsExpression('formatPoli'),
					'templateSelection' => new JsExpression('formatPoliSelection'),
					],
			])->label(false);?></div>
		<div class='col-md-1 formright'>Penjamin</div>
		<div class='col-md-1'><?= $form->field($model, 'penjamin')->dropDownList([ 'BPJS' => 'BPJS', 'UMUM' => 'UMUM', ], ['prompt' => ''])->label(false) ?></div>
		</div>
		<div class='row'>
		<div class='col-md-2 formright'>Diagnosa </div>
		<div class='col-md-2'>
		<?= $form->field($model, 'kd')->textinput(['placeholder' => 'KODE DIAGNOSA','onkeyup'=>'$.get("'.Url::toRoute('tes/listdiagnosa/').'",{ id: $(this).val() }).done(function( data ) 
									{
										  $( "select#diagnosaranap-kdiagnosa" ).html( data );
										  });'])->label(false)?>
            
				
		</div>
		<div class='col-md-2'>
		<select id="diagnosaranap-kdiagnosa" class="form-control" name='Rujukan[diagnosa]' aria-invalid="false">
				
				</select>
            
				
		</div>
		</div>
		<div class='row'>
		<div class='col-md-2 formright'>Kebutuhan </div>
		<div class='col-md-5'><?= $form->field($model, 'kebutuhan')->textarea(['rows'=>6])->label(false) ?></div>
		</div>
		
		<div class='row'>
		<div class='col-md-2 formright'>Tanggal </div>
		<div class='col-md-2'><?=	$form->field($model, 'tanggal')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd',
					'todayHighlight' => true]
					
					])->label(false);?></div>
		<div class='col-md-1 formright'>Jam </div>
		<div class='col-md-2'><?= $form->field($model, 'waktu')->widget(TimePicker::classname(), ['pluginOptions' => [
						'showSeconds' => false,
						'showMeridian' => false,
						'minuteStep' => 1,
						'secondStep' => 5,
					]])->label(false); ?></div>
		</div>
		
		
		

		</div>
		
	 <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>


</div>
<?php
/*ini modal untuk menampilkan list barang*/


/*ini modal untuk menampilkan list barang*/
Modal::begin([
	'id' => 'mdTemplate',
	'header' => '<h3>Pilih Template</h3>',
	'size'=>'modal-lg',
	'options'=>[
		'data-url'=>'transaksi',
	],
]);

echo '<div class="modalContent">'. $this->render('_dataTemplate', ['dataTemplate'=>$dataTemplate, ]).'</div>';
 
Modal::end();
?>