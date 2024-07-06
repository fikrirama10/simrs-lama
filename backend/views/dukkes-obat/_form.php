<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use common\models\Satuan;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\DukkesObat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dukkes-obat-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'namaobat')->textInput() ?>

    <?= $form->field($model, 'stok')->textInput() ?>

    <?=	$form->field($model, 'kadaluarsa')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label('Kadaluarsa');?>

    <?= $form->field($model, 'jenisobat')->dropDownList([ 'Alkes' => 'Alkes', 'Obat' => 'Obat', 'Lain Lain' => 'Lain Lain', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'idsatuan')->dropDownList(ArrayHelper::map(Satuan::find()->all(), 'id', 'satuan'),['prompt'=>'- Satuan -'])->label('',['class'=>'label-class'])->label('Satuan')?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
