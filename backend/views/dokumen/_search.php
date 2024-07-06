<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\DokumenKategori;
use common\models\DokumenJenis;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\DokumenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dokumen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

 <div class='row'>
	<div class='col-md-9'>
		<div class='row'>
			<div class='col-md-4'> <?= $form->field($model, 'Judul') ?></div>
			<div class='col-md-4'>   <?= $form->field($model, 'IdKat')->dropDownList(ArrayHelper::map(DokumenKategori::find()->all(), 'Id', 'Kategori'))->label('Kategori')?></div>
			<div class='col-md-4'>   <?= $form->field($model, 'IdJenis')->dropDownList(ArrayHelper::map(DokumenJenis::find()->all(), 'Id', 'Jenis'))->label('Jenis')?></div>
		</div>
	</div>
 </div>
  

  
  

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
