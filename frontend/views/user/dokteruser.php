<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Privilages;
use common\models\Dokter;
use yii\helpers\ArrayHelper;
 $tgl=date('dmY');
/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'kode_petugas')->textInput(['maxlength' => true]) ?>
	 <?= $form->field($model, 'kode_petugas')->dropDownList(ArrayHelper::map(Dokter::find()->all(), 'kodedokter', 'namadokter'),[
						'prompt'=>'- Pilih Dokter -',])?>
	<?= $form->field($model, 'idpriv')->dropDownList(ArrayHelper::map(Privilages::find()->all(), 'idpriv', 'privilages'))?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
	<?php $model->password = ($model->password)? $model->password_repeat : "" ?>
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
