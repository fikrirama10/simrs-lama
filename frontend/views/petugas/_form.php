<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Petugas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="petugas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_petugas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_petugas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nohp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textInput() ?>

    <?= $form->field($model, 'jk')->dropDownList([ 'L' => 'L', 'P' => 'P', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'foto')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
