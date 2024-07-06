<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Suplier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="suplier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'namasuplier')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nohp')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
