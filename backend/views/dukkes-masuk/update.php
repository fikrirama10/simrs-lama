<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DukkesMasuk */

$this->title = 'Update Dukkes Masuk: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dukkes Masuks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dukkes-masuk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
