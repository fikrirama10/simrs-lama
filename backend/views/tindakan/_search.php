<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TindakanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tindakan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idpoli') ?>

    <?= $form->field($model, 'namatindakan') ?>

    <?= $form->field($model, 'kattindakan') ?>

    <?= $form->field($model, 'tarif') ?>

    <?php // echo $form->field($model, 'ket') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
