<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Transaksi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaksi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idtrx')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_rm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idrawat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idbayar')->textInput() ?>

    <?= $form->field($model, 'tglbayar')->textInput() ?>

    <?= $form->field($model, 'iduser')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
