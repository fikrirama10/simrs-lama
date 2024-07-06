<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Katjenis;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\ArticlesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articles-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'namaobat') ?>
	<?= $form->field($model,'idjenis')->dropDownList(ArrayHelper::map(Katjenis::find()->all(),'id','katjenis'),['prompt'=>'- Pilih Jenis Barang -'])->label(false);?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
