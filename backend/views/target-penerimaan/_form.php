<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TargetPenerimaan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="target-penerimaan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kodetarget')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iduser')->textInput() ?>

    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bulan')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
