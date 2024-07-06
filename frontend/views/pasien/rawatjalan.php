<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

use common\models\Jenisbayar;
use common\models\Dokter;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
use common\models\Poli;
/* @var $this yii\web\View */
/* @var $model common\models\Pasisen */

//$this->title = $model->no_rekmed;
$this->params['breadcrumbs'][] = ['label' => 'Pasien  > Rawat Jalan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

   <?php $form = ActiveForm::begin(); ?>
	<div class="rawatjalan-form"  style='margin-top:20px;'>
	<div class='container-fluid'>

		<div class='row'>
			<div class='col-md-4'>
				<div class='box box-warning'>
					<div class='box box-header'>
						<h3>Data Pasien</h3>
					</div>
					<div class='box box-body'>
						<div class='row'>
							<div class='col-xs-5'>RM</div>
							<div class='col-xs-6'><a>: <?= $model->no_rekmed ?></a></div>
						</div>
						<div class='row'>
							<div class='col-xs-5'>Nama Pasien</div>
							<div class='col-xs-6'><a>: <?= $model->nama_pasien ?></a></div>
						</div>
						<div class='row'>
							<div class='col-xs-5'>Agama</div>
							<div class='col-xs-6'><a>: <?= $model->agama ?></a></div>
						</div>
						<div class='row'>
							<div class='col-xs-5'>Golongan Darah</div>
							<div class='col-xs-6'><a>: <?= $model->gol_darah ?></a></div>
						</div>
						<div class='row'>
							<div class='col-xs-5'>Gender</div>
							<div class='col-xs-6'><a>: <?= $model->jenis_kelamin ?></a></div>
						</div>
					</div>
				</div>
			</div>
			<div class='col-md-8'>
				<div class='box box-danger'>
					<div class='box box-header'>

						<h3>Form Rawat Jalan</h3>
					</div>
					<div class='box box-body'>
						<?= $form->field($rawatjalan, 'no_rekmed')->textInput(['value'=>$model->no_rekmed]) ?>
						<?= $form->field($lograwat, 'rm')->hiddeninput(['value'=>$model->no_rekmed]) ?>
						<?= $form->field($rawatjalan, 'idpoli')->dropDownList(ArrayHelper::map(Poli::find()->all(), 'id', 'namapoli'),['prompt'=>'- Poli Yang Dituju -','onchange'=>'$.get("'.Url::toRoute('pasien/listdok/').'",{ id: $(this).val() }).done(function( data ) 
							{
								  $( "select#rawatjalan-iddokter" ).html( data );
								});
							'])->label('Pilihan Poli',['class'=>'label-class'])->label()?>
						<?= $form->field($rawatjalan, 'iddokter')->dropDownList(ArrayHelper::map(Dokter::find()->where(['id'=>0])->all(), 'id', 'namadokter'),['prompt'=>'- Pilih Dokter -'])->label('Dokter',['class'=>'label-class'])->label()?>
						<?= $form->field($rawatjalan, 'idbayar')->dropDownList(ArrayHelper::map(Jenisbayar::find()->all(), 'id', 'jenisbayar'),['prompt'=>'- Pilih Jenisbayar -'])->label('',['class'=>'label-class'])->label()?>
						
					</div>
				</div>
				<div class='box box-default'>
				<div class='box box-body'>
					<div class="form-grup">
					<?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
						
					</div>
				</div>
			</div>
			
			
			
			</div>
		</div>
		
    <div class="form-group">
      
    </div>

<?php ActiveForm::end();  ?>

		
   
</div>
    

</div>
<?php 
$this->registerJs("
  $('#submitButton').click(function(){

        // $('#loading').show();

        $.prompt('We are uploading and processing your files, please wait and do not refresh this page……');

        // and when finish, call or reload your page:  $('#loading').hide();  

   });


", View::POS_READY);
?>
