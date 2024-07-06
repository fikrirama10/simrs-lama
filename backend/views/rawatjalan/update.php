<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Rawatjalan */

$this->title = 'Update Rawatjalan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rawatjalans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rawatjalan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
