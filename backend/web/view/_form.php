<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Indikatorigd */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="indikatorigd-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'namapetugas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jab')->dropDownList([ 'Dpjb' => 'Dpjb', 'Perawat' => 'Perawat', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'bls')->textInput() ?>

    <?= $form->field($model, 'blsterbit')->textInput() ?>

    <?= $form->field($model, 'blshabis')->textInput() ?>

    <?= $form->field($model, 'ppgd')->textInput() ?>

    <?= $form->field($model, 'ppgdterbit')->textInput() ?>

    <?= $form->field($model, 'ppgdhabis')->textInput() ?>

    <?= $form->field($model, 'gels')->textInput() ?>

    <?= $form->field($model, 'gelsterbit')->textInput() ?>

    <?= $form->field($model, 'gelshabis')->textInput() ?>

    <?= $form->field($model, 'als')->textInput() ?>

    <?= $form->field($model, 'alsterbit')->textInput() ?>

    <?= $form->field($model, 'alshabis')->textInput() ?>

    <?= $form->field($model, 'ket')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
