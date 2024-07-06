<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RikkesRadiologi */

$this->title = 'Update Rikkes Radiologi: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rikkes Radiologis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rikkes-radiologi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
