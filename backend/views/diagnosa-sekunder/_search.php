<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PemeriksaanUgddiagsekunderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pemeriksaan-ugddiagsekunder-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idpemeriksaan') ?>

    <?= $form->field($model, 'idrawat') ?>

    <?= $form->field($model, 'diagnosaprimer') ?>

    <?= $form->field($model, 'diagnosasekunder') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
