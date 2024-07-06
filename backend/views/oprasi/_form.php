<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Oprasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oprasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idoprasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idrawat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_rekmed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'catatan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tanggal')->textInput() ?>

    <?= $form->field($model, 'jenisoprasi')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
