<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pekerjaan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pekerjaan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jenis_pekerjaan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tempatkerja')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'alamat_kerja')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'notlp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idpasien')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
