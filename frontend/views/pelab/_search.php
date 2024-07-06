<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PelabSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelab-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tgl') ?>

    <?= $form->field($model, 'rm') ?>

    <?= $form->field($model, 'jenispemeriksaan') ?>

    <?= $form->field($model, 'jamdiambil') ?>

    <?php // echo $form->field($model, 'jamhasil') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
