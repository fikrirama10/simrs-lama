<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PoliSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="poli-search">

    <?php $form = ActiveForm::begin([
        'action' => ['poligigi2'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'no_rekmed') ?>

   
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
