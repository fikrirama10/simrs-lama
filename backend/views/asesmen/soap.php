<?php	
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\web\View;
use common\models\Diagnosa;
use common\models\Tindakan;
use common\models\Dokter;
use common\models\Rawatjalan;
use common\models\Perawat;
use common\models\Kesadaran;
use yii\helpers\ArrayHelper;

use Picqer\Barcode\BarcodeGeneratorHTML;
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
$rawajl= Rawatjalan::find()->where(['no_rekmed'=>$model->no_rekmed])->andwhere(['diagket'=>'TB+'])->count();
if($model->status == 0){
	echo"Pasien Dalam Tahap ".$model->sttatus->status."";
}
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
<div class="container-fluid" style='background:#fff; padding-top:10px;'>
 <?php $form = ActiveForm::begin(); ?>
<label>Dokter Pemeriksa</label>
<h4><?= $model->dokter->namadokter ?></h4>


<div class='row'>

				<?php if($rawajl > 0){ ?>
 <div class="callout callout-warning">
                <h4>Pasien Dengan Riwayat TB</h4>
	</div>
				<?php }else{echo"";}?>
	<div class='col-md-3'>
		<div class="box box-primary">
			<div class="box-body box-profile">
			<h3 class="profile-username text-center"><?= $model->pasien->sbb ?>. <?= $model->pasien->nama_pasien ?></h3>
			<p class="text-muted text-center" style='font-size:18px;'><b><?= $model->no_rekmed ?></b></p>
			<hr>
               <strong><i class="fa fa-venus-mars margin-r-5"></i> Jenis Kelamin</strong>

              <p class="text-muted">
				<?php if($model->pasien->jenis_kelamin == 'L'){echo"Laki - Laki";}else{echo"Perempuan";}?>
              </p>

              <hr>

              <strong><i class="fa fa-birthday-cake margin-r-5"></i>Tanggal Lahir </strong>

              <p class="text-muted"><?= date('d F Y',strtotime($model->pasien->tanggal_lahir))?> ( <?=$model->pasien->usia?>th )</p>

              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"><?= $model->pasien->alamat?></p>

              <hr>
			  <strong><i class="fa fa-balance-scale margin-r-5"></i> Agama</strong>

              <p class="text-muted"><?= $model->pasien->agama?></p>

              <hr>
               <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary btn-block']) ?>
            </div>
            <!-- /.box-body -->
          </div>
	</div>
	<div class='col-md-8'>
		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li  class="active"><a href="#tab_3-2" data-toggle="tab">Anamnesis</a></li>
            
              <li class="pull-left header"><i class="fa fa-th"></i> </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_3-2">
               <h3> Anamnesa / Anamnesis</h3>
    
					<div class='row'>
						<div class='col-md-12'>
						<?= $form->field($model, 'soap')->textarea(['rows' => '8','required'=>true])->label("SOAP")?>
						<?= $form->field($model, 'terapi')->textarea(['rows' => '4','required'=>true])->label("Terapi")?>
						<?= $form->field($model, 'tindakan')->textarea(['rows' => '4','required'=>true])->label("Tindakan")?>
						<?php if($model->idpoli == 1){ ?>
						<?= $form->field($model, 'pengobatan')->dropDownList(ArrayHelper::map(Tindakan::find()->where(['gigi'=>1])->all(), 'id', 'namatindakan') ,['prompt' => 'Pengobatan'])->label('Pengobatan')?>
						<?php }else{echo"";}?>
						
               <h3>Diagnosa</h3>
	
				<?= $form->field($model, 'kdiagnosa')->widget(Select2::classname(), [
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
				]);?>
			
					
						<?= $form->field($model, 'diagket')->textarea(['required'=>true]) ?>

							
						</div>
					</div>
          
              </div>
              <!-- /.tab-pane -->

              <!-- /.tab-pane -->
             
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
	
	</div>
</div>
 

    <?php ActiveForm::end(); ?>
</div>
