<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Dokter;
use common\models\Rawatjalan;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Orderlab */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orderlab-form">

    <?php $form = ActiveForm::begin(); ?>

   

   <?= $form->field($model, 'idpengirim')->dropDownList(ArrayHelper::map(Dokter::find()->all(), 'id', 'namadokter'))->label(false)?>

    <?= $form->field($model, 'no_rekmed')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'idrawat')->textInput(['maxlength' => true, 'readonly'=>true]) ?>
    <?=	$form->field($model, 'tgl_order')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label(false)?>

     <?= $form->field($model, 'idtkp')->dropDownList(ArrayHelper::map(Rawatjalan::find()->where(['idrawat'=>$model->idrawat])->all(), 'idjenisrawat', 'idjenisrawat'))->label(false)?>

   
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
