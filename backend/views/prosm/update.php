<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Prosm */

$this->title = 'Update Prosm: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Prosms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prosm-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
