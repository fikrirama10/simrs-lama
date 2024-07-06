<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Folmulir */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="folmulir-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jenisform')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
