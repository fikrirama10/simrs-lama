<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Asesmenpasien */

$this->title = 'Kelengkapan Assesmen Awal Medis Pasien Unit Gawat Darurat';
$this->params['breadcrumbs'][] = ['label' => 'Asesmenpasiens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asesmenpasien-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
