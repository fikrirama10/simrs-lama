<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Dafusg */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dafusg-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'namausg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tarif')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
