<?php
use common\models\PemeriksaanUgddiagsekunder;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\View;
use yii\web\JsExpression;
$no=1;
$sekunder = PemeriksaanUgddiagsekunder::find()->where(['idpemeriksaan'=>$rawat->id])->all();
$sc = PemeriksaanUgddiagsekunder::find()->where(['idpemeriksaan'=>$rawat->id])->count();
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
/* @var $model common\models\PemeriksaanUgddiagsekunder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pemeriksaan-ugddiagsekunder-form">
	<div class='box box-body'>
	 <h3><?= Html::encode($this->title) ?></h3>
	<div class='row'>
		<div class='col-md-6'>
			 <?php $form = ActiveForm::begin(); ?>
				
				<?= $form->field($model, 'diagnosasekunder')->widget(Select2::classname(), [
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
				])->label('Diagnosa Sekunder');?>		
		
				<div class="form-group">
					<?= Html::submitButton('+', ['class' => 'btn btn-success']) ?>
				</div>

				<?php ActiveForm::end(); ?>
				<hr>
				Diagnosa Primer
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Diagnosa</span>
					<input type='text' class='form-control' readonly value='<?= $rawat->diagnosa ?>'>
				</div>
				<hr>
				Diagnosa Sekunder
				<?php if($sc > 0){ ?>
					<table class='table table-bordered' >
						<tr>
							<th>No</th>
							<th>Diagnosa Sekunder</th>
							<th>#</th>
						</tr>
						<?php foreach($sekunder as $sk):?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $sk->diagnosasekunder ?></td>
							<td><a href='<?= Url::to(['diagnosa-sekunder/delete?id='.$sk->id]) ?>'><span class="label label-danger"><i class="fa fa-close"></i></span></a></td>
						</tr>
						<?php endforeach; ?>
						
					</table>
				<?php }?>
		</div>
		
	</div>
   
	</div>
</div>
