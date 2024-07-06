<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TargetPenerimaanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="target-penerimaan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kodetarget') ?>

    <?= $form->field($model, 'iduser') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'bulan') ?>

    <?php // echo $form->field($model, 'created') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
