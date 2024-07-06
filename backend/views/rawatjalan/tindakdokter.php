
<?php
$no = 1;
use common\models\Diagnosis;
use common\models\Rxfisik;
use common\models\Rxlabor;
use common\models\Diagnosa;
use common\models\Tindakan;
use common\models\Tindakandokter;
use common\models\Keluhan;
use common\models\Resepdokter;
use common\models\Obat;
use common\models\Dokter;
use yii\helpers\Url;
use common\models\Lab;
use yii\helpers\Html;
use common\models\Daflab;
use common\models\Kattindakanlab;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;
$total = 5;
$rxfisik = Rxfisik::find()->where(['no_rawat'=>$model->idrawat])->one();
$keluhan= Keluhan::find()->where(['kode_p'=>$model->idrawat])->one();
$tindakann = Tindakandokter::find()->where(['kode_rawat'=>$model->idrawat])->all();
$htindakan = Tindakandokter::find()->where(['kode_rawat'=>$model->idrawat])->count();
?>
<?php if($model->iddokter == 0){ ?>
	<h1>Data Dokter Kosong !!</h1>
	<a  href='<?= Yii::$app->params['baseUrl'].'/dashboard/asesmen/update/'.$model->id?>' >Silahkan Klik untuk Mengisi Dokter</a>
<?php }else{ ?>  

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
	<h3>Tindakan Dokter</h3><hr>
    <div class="row">
	
        <div class="col-sm-6">
		<div class='box box-body'>
			<div class='row'>
				<div class ='col-md-2 formright'> Pasien</div>
				<div class ='col-md-10'>
				<input type="text" placeholder='<?= $model->dokter->namadokter?>' class="form-control" readonly="" aria-invalid="false">
				
          </div>
			</div>
				<div class='row'>
				<div class ='col-md-2 formright'>Dokter</div>
				<div class ='col-md-10'>
				<input type="text" placeholder='<?= $model->dokter->namadokter?>' class="form-control" readonly="" aria-invalid="false">
				<?= $form->field($tind, 'iddokter')->hiddenInput(['maxlength' => true,'readonly'=>true,'value'=>$model->iddokter])->label(false) ?>
				</div>
			</div>
			
			<div class='row'>
				<div class ='col-md-2 formright'>No RM</div>
				<div class ='col-md-10'><?= $form->field($tind, 'rm')->textInput(['maxlength' => true,'readonly'=>true,'value'=>$model->no_rekmed])->label(false) ?></div>
			</div>
			<div class='row'>
				<div class ='col-md-2 formright'>Id Rawat</div>
				<div class ='col-md-10'><?= $form->field($tind, 'idrawat')->textInput(['maxlength' => true,'readonly'=>true,'value'=>$model->idrawat])->label(false) ?></div>
			</div>
			</div>
			.<div class="panel panel-info">
				<div class="panel-heading">Anamnesis</div>
				<div class="panel-body">
					<div class='row'>
						<div class='col-xs-4'> Keluhan Sekarang </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $keluhan->keluhan ?> </div>
					</div>
					<div class='row'>
						<div class='col-xs-4'> Penyakit Sekarang </div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $keluhan->rwt_penyakits ?> </div>
					</div>
					<div class='row'>
						<div class='col-xs-4'> Alergi</div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $keluhan->alergi ?> </div>
					</div>
					
			
			</div>	
			</div>	
			<div class="panel panel-warning">
				<div class="panel-heading">Diagnosis Dokter</div>
				<div class="panel-body">
				<div class='row'>
						<div class='col-xs-4'> Diagnosa Dokter</div>
						<div class='col-xs-1'> : </div>
						<div class='col-xs-7'> <?= $model->kdiagnosa?> <br></div>
					</div>
				
				</div>
			</div>
			
          
          
</div>
       
       

        <div class="col-sm-6">

    <?php DynamicFormWidget::begin([

        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]

        'widgetBody' => '.container-items', // required: css class selector

        'widgetItem' => '.item', // required: css class

        'limit' => $total, // the maximum times, an element can be cloned (default 999)

        'min' => 0, // 0 or 1 (default 1)

        'insertButton' => '.add-item', // css class

        'deleteButton' => '.remove-item', // css class

        'model' => $tindakan[0],

        'formId' => 'dynamic-form',

        'formFields' => [

            'kodelab',


        ],

    ]); ?>

    <div class="panel panel-default">

        <div class="panel-heading">

            <i class="fa fa-envelope"></i> Tindakandokter

            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Tindakan Dokter</button>

            <div class="clearfix"></div>

        </div>

        <div class="panel-body container-items"><!-- widgetContainer -->

            <?php foreach ($tindakan as $index => $tindakan): ?>

                <div class="item panel panel-default"><!-- widgetBody -->

                    <div class="panel-heading">

                        <span class="panel-title-address">Tindakan: <?= ($index) ?></span>

                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>

                        <div class="clearfix"></div>

                    </div>

                    <div class="panel-body">
				
                        <?php

                            // necessary for update action.

                            if (!$tindakan->isNewRecord) {

                                echo Html::activeHiddenInput($tindakan, "[{$index}]id");

                            }

                        ?>

                       
                     
                        <div class="row">
                        	<div class='col-md-12'>
							<div class='col-xs-12'> <?= $form->field($tindakan, "[{$index}]idtindakan")->dropDownList(ArrayHelper::map(Tindakan::find()->all(), 'id', 'namatindakan'),['prompt'=>'- Tindakan Dokter -'])?> 
			
							 
                        	</div>
                         
                        

                             
                            

                          
                        </div><!-- end:row -->


                     

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

    <?php DynamicFormWidget::end(); ?>

    <div class="form-group">

        <?= Html::submitButton($tindakan->isNewRecord ? 'Tindakan' : 'Tindakan', ['class' => 'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); ?>
<?php
$js = '

jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {

    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {

        jQuery(this).html("Tindakan: " + (index + 1))

    });


});


jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {

    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {

        jQuery(this).html("Tindakan: " + (index + 1))

    });

});

';


$this->registerJs($js);
?>
<?php } ?>