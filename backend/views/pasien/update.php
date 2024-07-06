<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pasisen */

$this->title = 'Update Pasisen: ' . $model->no_rekmed;
$this->params['breadcrumbs'][] = ['label' => 'Pasisens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_rekmed, 'url' => ['view', 'id' => $model->no_rekmed]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pasisen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formupdate', [
        'model' => $model,
    ]) ?>

</div>
