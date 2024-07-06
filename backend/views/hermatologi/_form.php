<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Hermatologi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hermatologi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idrawat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hb')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hbb')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
