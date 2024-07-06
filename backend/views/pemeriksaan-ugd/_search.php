<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PemeriksaanIgdSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pemeriksaan-igd-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kodeperiksa') ?>

    <?= $form->field($model, 'idrawat') ?>

    <?= $form->field($model, 'keluhanutama') ?>

    <?= $form->field($model, 'rwpenyakit') ?>

    <?php // echo $form->field($model, 'idkesadaran') ?>

    <?php // echo $form->field($model, 'td') ?>

    <?php // echo $form->field($model, 'nadi') ?>

    <?php // echo $form->field($model, 'pernapasan') ?>

    <?php // echo $form->field($model, 'suhu') ?>

    <?php // echo $form->field($model, 'ku_kepala') ?>

    <?php // echo $form->field($model, 'ku_leher') ?>

    <?php // echo $form->field($model, 'ku_tparu') ?>

    <?php // echo $form->field($model, 'ku_tjantung') ?>

    <?php // echo $form->field($model, 'abdomen') ?>

    <?php // echo $form->field($model, 'kulit') ?>

    <?php // echo $form->field($model, 'extremitas') ?>

    <?php // echo $form->field($model, 'lb_penunjanglain') ?>

    <?php // echo $form->field($model, 'therapi') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
