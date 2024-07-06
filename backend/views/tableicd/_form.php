<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Tableicd */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tableicd-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Inggris')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Indonesia')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
