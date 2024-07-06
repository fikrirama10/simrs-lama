<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Trxmanual */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trxmanual-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'usia')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'alamat')->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'ket')->dropDownList([ 'Lab' => 'Lab', 'Radiologi' => 'Radiologi', 'Lain Lain' => 'Lain Lain', ], ['prompt' => '']) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
