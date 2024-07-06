<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Diagnosa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diagnosa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kodediagnosa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diagnosa')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
