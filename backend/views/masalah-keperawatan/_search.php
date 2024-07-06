<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MasalahKeperawatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="masalah-keperawatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idrawat') ?>

    <?= $form->field($model, 'no_rekmed') ?>

    <?= $form->field($model, 'tgl') ?>

    <?= $form->field($model, 'user') ?>

    <?php // echo $form->field($model, 'idkategori') ?>

    <?php // echo $form->field($model, 'idsub') ?>

    <?php // echo $form->field($model, 'iddiagnosis') ?>

    <?php // echo $form->field($model, 'idtindakan') ?>

    <?php // echo $form->field($model, 'tindakan') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
