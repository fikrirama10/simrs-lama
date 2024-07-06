<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DukkesMasuk */

$this->title = 'Tambah barang masuk';
$this->params['breadcrumbs'][] = ['label' => 'Dukkes Masuks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dukkes-masuk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
