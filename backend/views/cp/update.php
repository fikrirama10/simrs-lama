<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cp */

$this->title = 'Update Cp: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
