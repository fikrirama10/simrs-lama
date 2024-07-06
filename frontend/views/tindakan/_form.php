<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Poli;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Tindakan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tindakan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idpoli')->dropDownList(ArrayHelper::map(Poli::find()->all(), 'id', 'namapoli'),['prompt'=>'- Poli Yang Dituju -'])->label('Pilihan Poli',['class'=>'label-class'])->label()?>

    <?= $form->field($model, 'namatindakan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tarif')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ket')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
