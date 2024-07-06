<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Dokter;
use yii\helpers\ArrayHelper;use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Radiologi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="radiologi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idrad')->textInput(['maxlength' => true]) ?>

   <?= $form->field($model, 'idpengirim')->dropDownList(ArrayHelper::map(Dokter::find()->all(), 'id', 'namadokter'))?>

    <?=	$form->field($model, 'tanggal')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					]);?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
