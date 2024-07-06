<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Radtemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="radtemplate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kesan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hasil')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'klinis')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
