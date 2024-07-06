<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Jenispengaduan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jenispengaduan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jenispengaduan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
