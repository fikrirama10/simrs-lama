<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TargetPenerimaan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="target-penerimaan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bulan')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
