<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Kelas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kelas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'namakelas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tarif_hari')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
