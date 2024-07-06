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
use common\models\Pemriklab;
$periksalab = Pemriklab::find()->where(['idlab'=>$model->id])->all();
$pasienlab = Pemriklab::find()->where(['idlab'=>$model->id])->groupby(['rm'])->all();
$countkat = Subkattindakanlab::find()->where(['idkat'=>$model->idkatjenisp])->count();
$countlab = Pemriklab::find()->where(['idlab'=>$model->id])->count();
$total = $countkat - $countlab;
//$hermatologi = Pemriklab::find()->where(['idrawat'=>$model->idrawat])->andwhere(['idjenisp'=>$model->idjenisp])->all();
?>

<div class="customer-form">
	<div class='row'>
				<?php foreach($pasienlab as $r):?>
					<div class='col-md-12'>
						<div class='box box-body'>
							<h3><?= $r->pasien->sbb ?>, <?= $r->pasien->nama_pasien?> ( <?= $r->pasien->jenis_kelamin ?> )</h3>
							<a style='color:grey;'><?= $r->rm ?> - Kode Rawat <?= $r->idrawat ?></a>
							<h6><?= $r->pasien->tempat_lahir?>, <?= date('d F Y',strtotime($r->pasien->tanggal_lahir)) ?> ,<?=$r->pasien->usia?> th</h6>
							
						</div>
					</div>
				<?php endforeach;?>
				</div>

	<?php if($countkat == $countlab){echo"";}else{ ?>
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="row">

        <div class="col-sm-6">

            <?= $form->field($labid, 'idrawat')->textInput(['maxlength' => true , 'value'=>$model->idrawat]) ?>

        </div>

        <div class="col-sm-6">

            <?= $form->field($labid, 'rm')->textInput(['maxlength' => true,'value'=>$model->no_rekmed]) ?>

        </div>

    </div>


    <div class="padding-v-md">

        <div class="line line-dashed"></div>

    </div>

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

            'idtindakan',

            'idkatindakan',

         
            'hasil',

        ],

    ]); ?>

    <div class="panel panel-default">

        <div class="panel-heading">

            <i class="fa fa-envelope"></i> Hasil Lab

            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Add Lab</button>

            <div class="clearfix"></div>

        </div>

        <div class="panel-body container-items"><!-- widgetContainer -->

            <?php foreach ($pemriklab as $index => $pemriklab): ?>

                <div class="item panel panel-default"><!-- widgetBody -->

                    <div class="panel-heading">

                        <span class="panel-title-address">Lab: <?= ($index + 1) ?></span>

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
                        	<div class='col-md-3'>
                        		 <?= $form->field($pemriklab,  "[{$index}]idkatindakan")->dropDownList(ArrayHelper::map(Subkattindakanlab::find()->where(['idkat'=>$model->idkatjenisp])->all(), 'id', 'nama'),['prompt'=>'- Tindakan Lab -','onchange'=>'$.get("'.Url::toRoute('pasien/listkel/').'",{ id: $(this).val() }).done(function( data ) 
								{
								  $( "select#pasien-idkel" ).html( data );
								});
								'])->label('idtindakan',['class'=>'label-class'])->label()?>
                        	</div>
                            <div class="col-md-8">

                                <?= $form->field($pemriklab, "[{$index}]hasil")->textInput(['maxlength' => true]) ?>
                            </div>
                        

                             
                            

                          
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
<?php } ?>
    <?php if($countlab == 0){echo"";}else{ ?>
   <div class='box box-body'>
    <h4>Pemeriksaan <b><?= $model->katlab->nama?></b></h4><hr>
    <table class='table table-responsive table-bordered'>
    	<tr>
    		<th>	Pemeriksaan</th>
    		<th>Hasil</th>
    		<th>Satuan</th>
    		<th>Rujukan</th>
    	</tr>
    	  <?php foreach($periksalab as $l):?>
    	<tr>
	   
	    	<td><?= $l->kat->nama?></td>
	    	<td><?= $l->hasil?></td>
	    	<td><?= $l->kat->satuan?></td>
	    	<?php if($l->pasien->jenis_kelamin == 'L'){
	    		echo"<td>".$l->kat->l."</td>";
	    	}else{
	    		echo"<td>".$l->kat->p."</td>";
	    	} ?>
	    
    	</tr>

    	 <?php endforeach;?>
    </table><br>
    <a class='btn btn-warning btn-md' href='<?= Url::to(['/lab/beres/'.$model->id]) ?>'>Selesai</span></a>
						
	</div>
<?php } ?>
</div>
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