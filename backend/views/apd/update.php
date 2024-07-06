<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Apd */

$this->title = 'Update Apd: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Apds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="apd-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
