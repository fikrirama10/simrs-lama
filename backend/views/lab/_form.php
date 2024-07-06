
<?php
$no = 1;
use common\models\Tindakandokter;
use common\models\Tindakan;
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

?>  

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="row">
	
        <div class="col-sm-6">
		<div class='box box-body'>
			<div class='row'>
				<div class ='col-md-2 formright'>ID Lab</div>
				<div class ='col-md-10'>
				 <?php ($labid->kodelab)? $labid->kodelab : $labid->genKode() ?>
            <?= $form->field($labid, 'kodelab')->textInput(['maxlength' => true,'readonly'=>true])->label(false) ?></div>
			</div>
				<div class='row'>
				<div class ='col-md-2 formright'>Pengirim</div>
				<div class ='col-md-10'><?= $form->field($labid, 'idpengirim')->dropDownList(ArrayHelper::map(Dokter::find()->all(), 'id', 'namadokter'))->label(false)?></div>
			</div>
			
			<div class='row'>
				<div class ='col-md-2 formright'>No RM</div>
				<div class ='col-md-10'><?= $form->field($labid, 'no_rekmed')->textInput(['maxlength' => true,'readonly'=>true,'value'=>$model->no_rekmed])->label(false) ?></div>
			</div>
			<div class='row'>
				<div class ='col-md-2 formright'>Id Rawat</div>
				<div class ='col-md-10'><?= $form->field($labid, 'idrawat')->textInput(['maxlength' => true,'readonly'=>true,'value'=>$model->idrawat])->label(false) ?></div>
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

        'model' => $pemriklab[0],

        'formId' => 'dynamic-form',

        'formFields' => [

            'kodelab',


        ],

    ]); ?>

    <div class="panel panel-default">

        <div class="panel-heading">

            <i class="fa fa-envelope"></i> Order Laboratorium

            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Add Laboratorium order</button>

            <div class="clearfix"></div>

        </div>

        <div class="panel-body container-items"><!-- widgetContainer -->

            <?php foreach ($pemriklab as $index => $pemriklab): ?>

                <div class="item panel panel-default"><!-- widgetBody -->

                    <div class="panel-heading">

                        <span class="panel-title-address">Lab: <?= ($index) ?></span>

                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>

                        <div class="clearfix"></div>

                    </div>

                    <div class="panel-body">
				
                        <?php

                            // necessary for update action.

                            if (!$pemriklab->isNewRecord) {

                                echo Html::activeHiddenInput($pemriklab, "[{$index}]id");

                            }

                        ?>

                       
                     
                        <div class="row">
                        	<div class='col-md-12'>
							<div class='col-xs-12'> <?= $form->field($pemriklab, "[{$index}]idkatjenisp")->dropDownList(ArrayHelper::map(Kattindakanlab::find()->all(), 'id', 'nama'),['prompt'=>'- Tindakan Lab -'])?> 
			
							 
                        	</div>
                         
                        

                             
                            

                          
                        </div><!-- end:row -->


                     

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

    <?php DynamicFormWidget::end(); ?>

    <div class="form-group">

        <?= Html::submitButton($pemriklab->isNewRecord ? 'Order' : 'Update', ['class' => 'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); ?>
<?php
$js = '

jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {

    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {

        jQuery(this).html("Lab: " + (index + 1))

    });


});


jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {

    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {

        jQuery(this).html("Lab: " + (index + 1))

    });

});

';


$this->registerJs($js);
?>