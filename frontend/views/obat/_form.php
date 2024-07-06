<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Obat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="obat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'noobat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'namaobat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kadaluarsa')->textInput() ?>

    <?= $form->field($model, 'idsuplier')->textInput() ?>

    <?= $form->field($model, 'harga')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idsatuan')->textInput() ?>

    <?= $form->field($model, 'idjenisobat')->textInput() ?>

    <?= $form->field($model, 'stok')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
