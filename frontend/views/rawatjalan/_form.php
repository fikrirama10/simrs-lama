<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Rawatjalan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rawatjalan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idrawat')->textInput(['value'=>$model->genKode()]) ?>

    <?= $form->field($model, 'no_rekmed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iddokter')->textInput() ?>

    <?= $form->field($model, 'idpoli')->textInput() ?>

    <?= $form->field($model, 'idbayar')->textInput() ?>

    <?= $form->field($model, 'iddiagnosa')->textInput() ?>

    <?= $form->field($model, 'tgldaftar')->textInput() ?>

    <?= $form->field($model, 'penanggung')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat_penanggung')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hubungan')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'notlp')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
