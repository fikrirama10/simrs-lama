<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pengeluaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengeluaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jabatan')->dropDownList([ 'Karumkit' => 'Karumkit', 'Perwira' => 'Perwira', 'Anggota' => 'Anggota', 'Staff' => 'Staff', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'biaya')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
