<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Dafrad */

$this->title = 'Update Dafrad: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dafrads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dafrad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
