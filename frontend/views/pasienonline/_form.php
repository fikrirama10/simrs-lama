<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pasienonline */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pasienonline-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nokartu')->textInput() ?>

    <?= $form->field($model, 'idbayar')->textInput() ?>

    <?= $form->field($model, 'noregistrasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal')->textInput() ?>

    <?= $form->field($model, 'idpoli')->textInput() ?>

    <?= $form->field($model, 'nama_pasien')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nohp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_lahir')->textInput() ?>

    <?= $form->field($model, 'usia')->textInput() ?>

    <?= $form->field($model, 'idprov')->textInput() ?>

    <?= $form->field($model, 'idkab')->textInput() ?>

    <?= $form->field($model, 'idkec')->textInput() ?>

    <?= $form->field($model, 'idkel')->textInput() ?>

    <?= $form->field($model, 'pendidikan')->textInput() ?>

    <?= $form->field($model, 'no_ktp')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
