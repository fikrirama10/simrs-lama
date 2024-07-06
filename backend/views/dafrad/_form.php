<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Dafrad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dafrad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jenispemeriksaan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tarif')->textInput() ?>

    <?= $form->field($model, 'ket')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
