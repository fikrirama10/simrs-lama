<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BarangMasuk */

$this->title = 'Create Barang Masuk';
$this->params['breadcrumbs'][] = ['label' => 'Barang Masuks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barang-masuk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
