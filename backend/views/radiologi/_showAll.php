<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;
use common\models\Dafrad;
use unclead\multipleinput\MultipleInput;
use unclead\multipleinput\TabularInput;
use common\models\Subkattindakanlab;
use \unclead\multipleinput\examples\models\Item;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use common\models\Dokter;
$total = 5;

//$hermatologi = Pemriklab::find()->where(['idrawat'=>$model->idrawat])->andwhere(['idjenisp'=>$model->idjenisp])->all();
?>
<div id='rad-ajax'>
<div class="customer-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="row">
	
        <div class="col-sm-6">
		<div class='box box-body'>
			<div class='row'>
				<div class ='col-md-2 formright'>ID Rad</div>
				<div class ='col-md-10'> <?php ($radid->idrad)? $radid->idrad : $radid->genKode() ?>
            <?= $form->field($radid, 'idrad')->textInput(['maxlength' => true])->label(false) ?></div>
			</div>
			<div class='row'>
				<div class ='col-md-2 formright'>Pengirim</div>
				<div class ='col-md-10'><?= $form->field($radid, 'idpengirim')->dropDownList(ArrayHelper::map(Dokter::find()->all(), 'id', 'namadokter'))->label(false)?></div>
			</div>
			
				<?php if($pasienc == 0 ){?>
				<div class='row'>
				<div class ='col-md-2 formright'>RM</div>
				<div class ='col-md-8'>  <?= $form->field($radid, 'no_rekmed')->textInput(['placeholder'=>'Data Pasien Tidak ditemukan','maxlength' => true])->label(false) ?></div>
				<div class='col-md-2 '><a id="show-all" class="btn btn-success" ><span class="fa fa-search" style="width: 15px;"></span></a></div></div>
				<?php }else{ ?>
				<div class='row'>
				<div class ='col-md-2 formright'>RM</div>
				<div class ='col-md-8'>  <?= $form->field($radid, 'no_rekmed')->textInput(['value'=>$pasien->no_rekmed,'maxlength' => true])->label(false) ?></div>
				<div class='col-md-2 '><a id="show-all" class="btn btn-success" ><span class="fa fa-search" style="width: 15px;"></span></a></div>
				</div>
				<div class='row'>
					<div class='col-md-2 formright'>Pasien</div>
					<div class='col-md-10 formright form-group'><input type='text' value='<?= $pasien->nama_pasien?>'class='form-control'></div>
				</div>
				<div class='row'>
					<div class='col-md-2 formright'>Usia</div>
					<div class='col-md-10 formright form-group'><input type='text' value='<?= $pasien->usia?> th'class='form-control'></div>
				</div>
				<div class='row'>
					<div class='col-md-2 formright'>Alamat</div>
					<div class='col-md-10 formright form-group'><input type='text' value='<?= $pasien->alamat?>'class='form-control'></div>
				</div>
				<?php } ?>
				
			
			
			
			
          
          
</div>
        </div></div>

        <div class="col-sm-6">

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

            'idrad',

           
         
            'hasil',

        ],

    ]); ?>

    <div class="panel panel-default">

        <div class="panel-heading">

            <i class="fa fa-envelope"></i> Order Radiologi

            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Add Radiologi order</button>

            <div class="clearfix"></div>

        </div>

        <div class="panel-body container-items"><!-- widgetContainer -->

            <?php foreach ($raddetail as $index => $raddetail): ?>

                <div class="item panel panel-default"><!-- widgetBody -->

                    <div class="panel-heading">

                        <span class="panel-title-address">Lab: <?= ($index + 1) ?></span>

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
                        	<div class='col-md-12'>
							 <?= $form->field($raddetail,  "[{$index}]idjenisrad")->dropDownList(ArrayHelper::map(Dafrad::find()->all(), 'id', 'jenispemeriksaan'),['prompt'=>'- Tindakan Rad -'])->label('idtindakan',['class'=>'label-class'])->label()?>
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
$urlShowAll = Url::to(['radiologi/show-all']);
$this->registerJs("
	
	$('#show-all').on('click',function(){
	
			norm = $('#radiologi-no_rekmed').val();
			$.ajax({
				type: 'GET',
				url: '{$urlShowAll}',
				data: 'id='+norm,
				success: function (data) {
					if(norm == ''){
					
					alert('isi nomer bpjs');
					$('body,html').animate({ scrollTop: 0 }, 200);
					$('#pasien-ajax').html(data);
					
					
					}else{
					$('#pasien-ajax').html(data);
					
					
					
					console.log(data);
					}
				},
			});
		
	});

            $('#pasien-tanggal_lahir').on('change',function() {
                var dob = new Date(this.value);
                var today = new Date();
                var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
                $('#pasien-usia').val(age);
            });
				$('#tni').addClass('disabel');
				
		
				$('#pekerjaan-idjenis').on('change',function() {
				
                var dob = $('#pekerjaan-idjenis').val();
				$('#coba').val(dob);
				if(dob < 5){
				$('#tni').removeClass('disabel');
				
				}else{
				$('#tni').addClass('disabel');
				}
				});
        
	

", View::POS_READY);
?>