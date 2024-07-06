<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsepSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="csep-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'noKartu') ?>

    <?= $form->field($model, 'tglSEP') ?>

    <?= $form->field($model, 'ppkPelayanan') ?>

    <?= $form->field($model, 'jnsPelayanan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
