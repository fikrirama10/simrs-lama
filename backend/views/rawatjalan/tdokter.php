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
$tindakan = Tindakandokter::find()->where(['kode_rawat'=>$model->idrawat])->andwhere(['DATE_FORMAT(tgl,"%Y-%m-%d")' => date('Y-m-d')])->all();
?>	
<div class='box box-body'>
<h3>Tindakan Dokter IGD</h3><hr>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],'id'=>'formSubmit']); ?>						 

						 
<?= $form->field($tindakandokter, 'kode_rawat')->hiddeninput(['value'=>$model->idrawat])->label(false); ?>
<?= $form->field($tindakandokter, 'no_rekmed')->hiddeninput(['value'=>$model->no_rekmed])->label(false); ?>
<div class='col-xs-12'> <?= $form->field($tindakandokter, 'penindak')->dropDownList(ArrayHelper::map(Dokter::find()->where(['idpoli'=>null])->all(), 'id', 'namadokter'),['prompt'=>'- Pilih Dokter -'])->label("Dokter Pemeriksa")?>		</div>
<div class='col-xs-12'> <?= $form->field($tindakandokter, 'idtindakan')->dropDownList(ArrayHelper::map(Tindakan::find()->all(), 'id', 'namatindakan'),['prompt'=>'- Tindakan Dokter -'])?> </div>

<div class='col-xs-12'> <?= $form->field($tindakandokter, 'ditindakoleh')->textinput(); ?> </div>
<div class='col-xs-12'> <?= $form->field($tindakandokter, 'tarif')->hiddeninput()->label(false); ?> </div>
<div class='col-xs-12'><?= Html::submitButton('Tindak', ['class' => 'btn btn-success']) ?></div>
								
<?php ActiveForm::end(); ?>
<div class='col-md-12' style='margin-top:20px;'>
	<div class='box box-body'>
	<h5><?= $model->pasien->sbb?>. <?= $model->pasien->nama_pasien ?></h5>
	<h6>RM  <?= $model->no_rekmed ?></h6><hr>
	<table class="table table-hover">
		<tr>
			<th>Nama Tindakan</th>
			<th>Dokter Penanggung Jawab</th>
			<th>Di tindak Oleh</th>
			
			<th>#</th>
		</tr>
	<?php foreach($tindakan as $t):?>
		<tr>
			<td><?= $t->tindakan->namatindakan ?></td>
			<td><?= $t->dokter->namadokter ?></td>
			<td></td>
			<td><a href='<?= Url::to(['rawatinap/delete/'.$t->id]) ?>'><span class="label label-danger"><i class="fa fa-close"></i></span></td></a>
		</tr>
	<?php endforeach; ?>
	</table>
	
	</div>
	<a href='<?= Url::to(['asesmen/awaligd/'.$model->id]) ?>' class='btn btn-primary btn-xs pull-right' style='margin-bottom:10px;'>Selesai</a>
	</div>
	</div>
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