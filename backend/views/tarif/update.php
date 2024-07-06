<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tarif */

$this->title = 'Update Tarif: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Tarif', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tarif-update">
<div class="box box-body">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
