<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use kartik\checkbox\CheckboxX;
use common\models\Jenisbayar;
use common\models\Dokter;
use kartik\date\DatePicker;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
use common\models\Poli;
/* @var $this yii\web\View */
/* @var $model common\models\Rawatjalan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rawatjalan-form">

    <?php $form = ActiveForm::begin(); ?>


	<?= $form->field($model, 'idpoli')->dropDownList(ArrayHelper::map(Poli::find()->all(), 'id', 'namapoli'),['prompt'=>'- Poli Yang Dituju -','onchange'=>'$.get("'.Url::toRoute('pasien/listdok/').'",{ id: $(this).val() }).done(function( data ) 
	{
		  $( "select#rawatjalan-iddokter" ).html( data );
		});

	'])->label('Pilihan Poli',['class'=>'label-class'])->label()?>

	<?= $form->field($model, 'iddokter')->dropDownList(ArrayHelper::map(Dokter::find()->where(['id'=>0])->all(), 'id', 'namadokter'),['prompt'=>'- Pilih Dokter -'])->label('Dokter',['class'=>'label-class'])->label()?>
	<?= $form->field($model, 'idbayar')->dropDownList(ArrayHelper::map(Jenisbayar::find()->all(), 'id', 'jenisbayar'),['prompt'=>'- Pilih Jenisbayar -'])->label('',['class'=>'label-class'])->label()?>
	<?=	$form->field($model, 'tgldaftar')->widget(DatePicker::classname(),[
		'type' => DatePicker::TYPE_COMPONENT_APPEND,
		'pluginOptions' => [
		'autoclose'=>true,
		'format' => 'yyyy-mm-dd',
		'todayHighlight' => true,
		]
		])->label('Jadwal Berobat');?>
	<?php if($model->idjenisrawat == 2): ?>
	<?=	$form->field($model, 'tglmasuk')->widget(DatePicker::classname(),[
		'type' => DatePicker::TYPE_COMPONENT_APPEND,
		'pluginOptions' => [
		'autoclose'=>true,
		'format' => 'yyyy-mm-dd',
		'todayHighlight' => true,
		]
		])->label('Tgl Masuk');?>
	<?php endif; ?>
	<input type="checkbox"  name="Rawatjalan[anggota]" id="lengkap" value="1">Anggota
   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
