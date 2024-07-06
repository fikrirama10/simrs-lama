<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Kelas;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Kamar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kamar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'namaruangan')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'idkelas')->dropDownList(ArrayHelper::map(Kelas::find()->all(), 'id', 'namakelas'),[
						'prompt'=>'- Pilih Kelas -',])?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
