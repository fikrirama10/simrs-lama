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

    <?= $form->field($model, 'hasil')->textInput(['maxlength' => true]) ?> 
    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
