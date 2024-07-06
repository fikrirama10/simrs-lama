<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UsgSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usg-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
	<div class='row'>
		<div class='col-md-6'>
			<div class='row'>
				<div class='col-xs-4'><?= $form->field($model, 'no_rekmed', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]) ?></div>
				<div class='col-xs-4'><?= $form->field($model, 'nama') ?></div>
			</div>
			
			
		</div>
	</div>
   

    

   

    <?php // echo $form->field($model, 'jenis_kelamin') ?>

    <?php // echo $form->field($model, 'usia') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'tglusg') ?>

    <?php // echo $form->field($model, 'jam') ?>

    <?php // echo $form->field($model, 'petugas') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
