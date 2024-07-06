<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Rawat */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Mcu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rawat-view">

    <h1><?= Html::encode($this->title) ?></h1>   
	<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($revmcu, 'nofoto')->textInput(['maxlength' => true,'value'=>$model->nofoto]) ?>
    <?= $form->field($revmcu, 'kesan')->textarea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
