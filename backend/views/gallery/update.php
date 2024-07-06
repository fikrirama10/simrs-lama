<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Galery */

$this->title = 'Update Galery: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Galeries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="galery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
