<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Usg */

$this->title = 'Update Usg: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Usgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="usg-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
