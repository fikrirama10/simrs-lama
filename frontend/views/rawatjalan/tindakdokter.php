<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;
use common\models\Kattindakanlab;
use unclead\multipleinput\MultipleInput;
use unclead\multipleinput\TabularInput;
use common\models\Subkattindakanlab;
use \unclead\multipleinput\examples\models\Item;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use common\models\Tindakandokter;
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
<div class="customer-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="row">

        <div class="col-sm-6">

            <?= $form->field($tind, 'idrawat')->textInput(['maxlength' => true , 'value'=>$model->idrawat]) ?>

        </div>

        <div class="col-sm-6">

            <?= $form->field($tind, 'rm')->textInput(['maxlength' => true,'value'=>$model->no_rekmed]) ?>

        </div>

    </div>


    <div class="padding-v-md">

        <div class="line line-dashed"></div>

    </div>

    <?php DynamicFormWidget::begin([

        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]

        'widgetBody' => '.container-items', // required: css class selector

        'widgetItem' => '.item', // required: css class

        'limit' => 0, // the maximum times, an element can be cloned (default 999)

        'min' => 0, // 0 or 1 (default 1)

        'insertButton' => '.add-item', // css class

        'deleteButton' => '.remove-item', // css class

        'model' => $tindakan[0],

        'formId' => 'dynamic-form',

        'formFields' => [

            'penindak',

            'tindakann',
            'ditindakoleh',
            'tarif',

         
            '',

        ],

    ]); ?>

    <div class="panel panel-default">

        <div class="panel-heading">

            <i class="fa fa-envelope"></i> Hasil Lab

            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Add Lab</button>

            <div class="clearfix"></div>

        </div>

        <div class="panel-body container-items"><!-- widgetContainer -->

            <?php foreach ($tindakan as $index => $tindakan): ?>

                <div class="item panel panel-default"><!-- widgetBody -->

                    <div class="panel-heading">

                        <span class="panel-title-address">Lab: <?= ($index + 1) ?></span>

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

                      
                            

                          
                        </div><!-- end:row -->


                     

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

    <?php DynamicFormWidget::end(); ?>

    <div class="form-group">

        <?= Html::submitButton($pemriklab->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); ?>
<?php
