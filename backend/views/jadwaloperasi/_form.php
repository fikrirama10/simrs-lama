<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Poli;
use common\models\Jenisbayar;
use common\models\Pasien;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Jadwaloprasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jadwaloprasi-form">

    <?php $form = ActiveForm::begin(); ?>

   
    <?= $form->field($model, 'no_rekmed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nobpjs')->textInput(['maxlength' => true]) ?>

	<?=	$form->field($model, 'tglpelaksanaan')->widget(DatePicker::classname(),[
	'type' => DatePicker::TYPE_COMPONENT_APPEND,
	'pluginOptions' => [
	'autoclose'=>true,
	'format' => 'yyyy-mm-dd',
	'todayHighlight' => true,
	]
	])->label('Jadwal Operasi');?>

    <?= $form->field($model, 'jenistindakan')->textArea(['rows' => 6]) ?>

	<?= $form->field($model, 'idpoli')->dropDownList(ArrayHelper::map(Poli::find()->all(), 'id', 'namapoli'),['prompt'=>'- Poli -'])->label('Pilihan Poli',['class'=>'label-class'])->label('Poli')?>


    <?= $form->field($model, 'idbayar')->dropDownList(ArrayHelper::map(Jenisbayar::find()->all(), 'id', 'jenisbayar'),['prompt'=>'- Jenis Bayar -'])->label('Jenis Bayar')?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
