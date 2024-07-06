<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PradiologiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pradiologi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'jamdiambil') ?>

    <?= $form->field($model, 'jamhasil') ?>

    <?= $form->field($model, 'durasi') ?>

    <?php // echo $form->field($model, 'jenispemeriksaan') ?>

    <?php // echo $form->field($model, 'no_rekmed') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
