<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PemeriksaanawalRanap */

$this->title = 'Update Pemeriksaanawal Ranap: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pemeriksaanawal Ranaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pemeriksaanawal-ranap-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
