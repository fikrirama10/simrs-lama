<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ApotekUnit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="apotek-unit-form">

    <?php $form = ActiveForm::begin(); ?>
		<?= $form->field($model, 'unit')->dropDownList([ 'UGD' => 'UGD', 'OK' => 'OK', 'Rajal' => 'Rajal', 'Ranap' => 'Ranap', 'Lab' => 'Lab', 'Radiologi' => 'Radiologi', 'CSSD' => 'CSSD', ], ['prompt' => '']) ?>
		<?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
