<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\JadwaldokterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jadwaldokter-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idhari') ?>

    <?= $form->field($model, 'iddokter') ?>

    <?= $form->field($model, 'mulaijam') ?>

    <?= $form->field($model, 'selesaijam') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
