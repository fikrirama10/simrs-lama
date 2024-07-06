<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Rekamedis */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rekamedis-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_rekmed')->textInput(['maxlength' => true]) ?>

   <?=	$form->field($model, 'tglpinjam')->widget(DatePicker::classname(),[
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
					]
					])->label(false);?>

    <?= $form->field($model, 'peminjam')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
