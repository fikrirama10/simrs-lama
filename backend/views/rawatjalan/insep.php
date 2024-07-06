<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use kartik\checkbox\CheckboxX;
use common\models\Jenisbayar;
use common\models\Dokter;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
use common\models\Poli;
/* @var $this yii\web\View */
/* @var $model common\models\Rawatjalan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rawatjalan-form">

    <?php $form = ActiveForm::begin(); ?>
	<?= $form->field($model, 'nosep')->textinput(['placeholder'=>'Nomor SEP']) ?>
	<?= $form->field($model, 'kdiagnosa')->textinput(['placeholder'=>'Diagnosa']) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
