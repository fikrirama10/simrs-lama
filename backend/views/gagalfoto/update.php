<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Gagalfoto */

$this->title = 'Update Gagalfoto: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Gagalfotos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gagalfoto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
