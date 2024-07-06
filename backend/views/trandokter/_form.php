<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Trandokter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trandokter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'namadokter')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
