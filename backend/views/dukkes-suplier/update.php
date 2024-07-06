<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DukkesSuplier */

$this->title = 'Update Dukkes Suplier: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dukkes Supliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dukkes-suplier-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
