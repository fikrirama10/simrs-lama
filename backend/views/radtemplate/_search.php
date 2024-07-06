<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RadtemplateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="radtemplate-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kesan') ?>

    <?= $form->field($model, 'keterangan') ?>

    <?= $form->field($model, 'hasil') ?>

    <?= $form->field($model, 'klinis') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
