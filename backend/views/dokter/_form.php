<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Poli;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Dokter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dokter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kodedokter')->textInput() ?>

    <?= $form->field($model, 'namadokter')->textInput(['maxlength' => true]) ?>

   <?= $form->field($model, 'idpoli')->dropDownList(ArrayHelper::map(Poli::find()->all(), 'id', 'namapoli'),[
						'prompt'=>'- Pilih Poli -',])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
