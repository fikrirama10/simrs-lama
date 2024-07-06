<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Tindakandokter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tindakandokter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_rawat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idtindakan')->textInput() ?>

    <?= $form->field($model, 'tarif')->textInput() ?>

    <?= $form->field($model, 'penindak')->textInput() ?>

    <?= $form->field($model, 'ditindakoleh')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
