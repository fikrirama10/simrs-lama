<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DukkesSuplier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dukkes-suplier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'suplier')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'asal')->dropDownList([ 'Negara' => 'Negara', 'Swasta' => 'Swasta', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
