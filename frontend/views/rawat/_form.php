<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Rawat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rawat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idpengirim')->textInput() ?>

    <?= $form->field($model, 'waktudikirim')->textInput() ?>

    <?= $form->field($model, 'idrawat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idp')->textInput() ?>

    <?= $form->field($model, 'ket')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
