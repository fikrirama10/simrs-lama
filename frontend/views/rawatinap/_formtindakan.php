<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use common\models\Diagnosis;
use common\models\Rxfisik;
use common\models\Rxlabor;
use common\models\Diagnosa;
use common\models\Tindakan;
use common\models\Tindakandokter;
use common\models\Keluhan;
use common\models\Dokter;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
?>	
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],'id'=>'formSubmit']); ?>						 

								 
<?= $form->field($tindakandokter, 'kode_rawat')->hiddeninput(['value'=>$model->idrawat])->label(false); ?>
<?= $form->field($tindakandokter, 'no_rekmed')->hiddeninput(['value'=>$model->no_rekmed])->label(false); ?>
<?= $form->field($tindakandokter, 'penindak')->hiddeninput(['value'=>$model->iddokter])->label(false); ?>
<div class='col-xs-12'> <?= $form->field($tindakandokter, 'idtindakan')->dropDownList(ArrayHelper::map(Tindakan::find()->all(), 'id', 'namatindakan'),['prompt'=>'- Tindakan Dokter -'])?> </div>

<div class='col-xs-12'> <?= $form->field($tindakandokter, 'ditindakoleh')->textinput(); ?> </div>
<div class='col-xs-12'> <?= $form->field($tindakandokter, 'tarif')->hiddeninput()->label(false); ?> </div>
<div class='col-xs-12'><?= Html::submitButton('Tindak', ['class' => 'btn btn-success']) ?></div>
								
<?php ActiveForm::end(); ?>
<?php 
$script = <<< JS
$('#formSubmit').on("submit",function(e){
      
        var formData = new FormData(this);
        var formURL = $("#formSubmit").attr("action");
        $.ajax(
        {
            url : formURL,
            type: "POST",
            data : formData,
            contentType: false,
            processData: false,
            success:function(data, textStatus, jqXHR) 
            {
               alert("success");
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                alert("gagal");      
            }
        });
        e.preventDefault();
        e.unbind(); untuk mencegah berkali kali submit
    }); 
JS;
$this->registerJs($script, View::POS_END);
?>