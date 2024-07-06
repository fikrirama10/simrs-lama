<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;
use kartik\time\TimePicker;
use kartik\date\DatePicker;
use common\models\Obat;
use common\models\Satuan;
use common\models\Suplier;
use unclead\multipleinput\MultipleInput;
use unclead\multipleinput\TabularInput;
use common\models\Subkattindakanlab;
use \unclead\multipleinput\examples\models\Item;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use common\models\Dokter;
use kartik\select2\Select2;
$total = 5;
//$hermatologi = Pemriklab::find()->where(['idrawat'=>$model->idrawat])->andwhere(['idjenisp'=>$model->idjenisp])->all();
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="row">
	
        <div class="col-sm-4">
		<div class='box box-body'>
		<h4>Distribusi</h4><hr>
			<div class='row'>
				<div class ='col-md-4 formright'>No Distribusi</div>
				<div class ='col-md-8'>
            <?= $form->field($radid, 'nodistri')->textInput(['maxlength' => true])->label(false) ?></div>
			</div>
		
			<div class='row'>
				<div class ='col-md-4 formright'>Tanggal</div>
				<div class ='col-md-8'><?=	$form->field($radid, 'tanggal')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label(false);?></div>
			</div>
			<div class='row'>
				<div class ='col-md-4 formright'>Distribusi ke</div>
				<div class ='col-md-8'><?= $form->field($radid, 'tempat')->dropDownList([ 'Farmasi' => 'Farmasi', 'Perawatan' => 'Perawatan','Igd' => 'Igd', ], ['prompt' => '--  Distribusi  --'])->label(false) ?></div>
			</div>
			
					<div class='row'>
				<div class ='col-md-4 formright'>Ket</div>
				<div class ='col-md-8'>
            <?= $form->field($radid, 'ket')->textInput(['maxlength' => true])->label(false) ?></div>
			</div>
			
          
          
</div>
        </div>

        <div class="col-sm-8">

    <?php DynamicFormWidget::begin([

        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]

        'widgetBody' => '.container-items', // required: css class selector

        'widgetItem' => '.item', // required: css class

        'limit' => $total, // the maximum times, an element can be cloned (default 999)

        'min' => 0, // 0 or 1 (default 1)

        'insertButton' => '.add-item', // css class

        'deleteButton' => '.remove-item', // css class

        'model' => $raddetail[0],

        'formId' => 'dynamic-form',

        'formFields' => [

        'idobat',
		'jumlah',
		'idsatuan',

        ],

    ]); ?>

    <div class="panel panel-default">

        <div class="panel-heading">

            <i class="fa fa-envelope"></i> Order Obat

            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Add Obat</button>

            <div class="clearfix"></div>

        </div>

        <div class="panel-body container-items"><!-- widgetContainer -->

            <?php foreach ($raddetail as $index => $raddetail): ?>

                <div class="item panel panel-default"><!-- widgetBody -->

                    <div class="panel-heading">

                        <span class="panel-title-address">Obat: <?= ($index + 1) ?></span>

                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>

                        <div class="clearfix"></div>

                    </div>

                    <div class="panel-body">

                        <?php

                            // necessary for update action.

                            if (!$raddetail->isNewRecord) {

                                echo Html::activeHiddenInput($raddetail, "[{$index}]id");

                            }

                        ?>

                       
                     
                        <div class="row">
                        	<div class='col-md-5'>
							 <?= $form->field($raddetail,  "[{$index}]idobat")->dropDownList(ArrayHelper::map(Obat::find()->all(), 'id', 'namaobat'),['prompt'=>'- Obat -'])->label('Nama Obat')?>
							 
                        	</div>
							<div class='col-md-2'>
								 <?= $form->field($raddetail,  "[{$index}]jumlah")->textInput() ?>
							</div>
							<div class='col-md-2'>
								<?= $form->field($raddetail, "[{$index}]idsatuan")->dropDownList(ArrayHelper::map(Satuan::find()->all(), 'id', 'satuan'),['prompt'=>'- Satuan -'])->label('Satuan')?> 
							</div>
							
							
                         
                        

                             
                            

                          
                        </div><!-- end:row -->


                     

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

    <?php DynamicFormWidget::end(); ?>

    <div class="form-group">

        <?= Html::submitButton($raddetail->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); ?>

           
        </div>

    </div>


    <div class="padding-v-md">

        <div class="line line-dashed"></div>

    </div>

</div>
<?php
$js = '

jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {

    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {

        jQuery(this).html("Obat: " + (index + 1))

    });

});


jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {

    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {

        jQuery(this).html("Obat: " + (index + 1))

    });

});

';


$this->registerJs($js);
?>