<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use kartik\checkbox\CheckboxX;
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

   <?php $form = ActiveForm::begin([ 
   'id' => 'myform',
   'options' => ['name' => 'your-name',]]); ?>
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
						<?= $form->field($lograwat, 'rm')->hiddeninput(['value'=>$model->no_rekmed])->label(false) ?>
						<?php if($model->jenis_kelamin == 'L'){ ?>
							<?php if($model->usia <=17){ ?>
							<?= $form->field($rawatjalan, 'idpoli')->dropDownList(ArrayHelper::map(Poli::find()->where(['between','id',1,4])->andwhere(['anak'=>1])->all(), 'id', 'namapoli'),['prompt'=>'- Poli Yang Dituju -','onchange'=>'$.get("'.Url::toRoute('pasien/listdok/').'",{ id: $(this).val() }).done(function( data ) 
								{
									  $( "select#rawatjalan-iddokter" ).html( data );
									});
							
								'])->label('Pilihan Poli',['class'=>'label-class'])->label()?>
							<?php }else{ ?>
									<?= $form->field($rawatjalan, 'idpoli')->dropDownList(ArrayHelper::map(Poli::find()->where(['between','id',1,4])->andwhere(['dewasa'=>1])->all(), 'id', 'namapoli'),['prompt'=>'- Poli Yang Dituju -','onchange'=>'$.get("'.Url::toRoute('pasien/listdok/').'",{ id: $(this).val() }).done(function( data ) 
								{
									  $( "select#rawatjalan-iddokter" ).html( data );
									});
							
								'])->label('Pilihan Poli',['class'=>'label-class'])->label()?>
							<?php } ?>
						<?php }else{ ?>
							<?php if($model->usia <=16){ ?>
							<?= $form->field($rawatjalan, 'idpoli')->dropDownList(ArrayHelper::map(Poli::find()->where(['anak'=>1])->all(), 'id', 'namapoli'),['prompt'=>'- Poli Yang Dituju -','onchange'=>'$.get("'.Url::toRoute('pasien/listdok/').'",{ id: $(this).val() }).done(function( data ) 
								{
									  $( "select#rawatjalan-iddokter" ).html( data );
									});
							
								'])->label('Pilihan Poli',['class'=>'label-class'])->label()?>
							<?php }else{ ?>
									<?= $form->field($rawatjalan, 'idpoli')->dropDownList(ArrayHelper::map(Poli::find()->where(['dewasa'=>1])->all(), 'id', 'namapoli'),['prompt'=>'- Poli Yang Dituju -','onchange'=>'$.get("'.Url::toRoute('pasien/listdok/').'",{ id: $(this).val() }).done(function( data ) 
								{
									  $( "select#rawatjalan-iddokter" ).html( data );
									});
							
								'])->label('Pilihan Poli',['class'=>'label-class'])->label()?>
							<?php } ?>
						<?php } ?>
						<?= $form->field($rawatjalan, 'iddokter')->dropDownList(ArrayHelper::map(Dokter::find()->where(['id'=>0])->all(), 'id', 'namadokter'),['prompt'=>'- Pilih Dokter -'])->label('Dokter',['class'=>'label-class'])->label()?>
						<?= $form->field($rawatjalan, 'idbayar')->dropDownList(ArrayHelper::map(Jenisbayar::find()->all(), 'id', 'jenisbayar'),['prompt'=>'- Pilih Jenisbayar -'])->label('',['class'=>'label-class'])->label()?>
						
					<?=$form->field($rawatjalan, 'anggota', [
						'template' => '{input}{label}{error}{hint}',
						'labelOptions' => ['class' => 'cbx-label']
						])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Anggota ?'); 
					?>
					<?=$form->field($rawatjalan, 'rencranap', [
						'template' => '{input}{label}{error}{hint}',
						'labelOptions' => ['class' => 'cbx-label']
						])->widget(CheckboxX::classname(), ['autoLabel'=>false])->label('Rawat  ?'); 
					?>
					</div>
				</div>
				<div class='box box-default'>
				<div class='box box-body'>
					<div class="form-grup">
					<?= Html::submitButton('Simpan', ['class' => 'btn btn-success','id'=>'mysubmit']) ?>
						
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
		 $('#myform').on('beforeSubmit',function(e){
            e.preventDefault();
            $('#mysubmit').css({pointerEvents:'none'});
            return true;
        });

            $('#pasien-tanggal_lahir').on('change',function() {
                var dob = new Date(this.value);
                var today = new Date();
                var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
                $('#pasien-usia').val(age);
            });
				$('#tni').addClass('disabel');
				
		
				// $('#rawatjalan-idpoli').on('change',function() {
				
                // var dob = $('#rawatjalan-idpoli').val();
				// $('#rawatjalan-antrian').val(dob);
				
				// });
        
	

", View::POS_READY);
?>
