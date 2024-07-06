<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PemeriksaanRanapVisite */

$this->title = 'Create Pemeriksaan Ranap Visite';
$this->params['breadcrumbs'][] = ['label' => 'Pemeriksaan Ranap Visites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemeriksaan-ranap-visite-create">

    <?= $this->render('_form', [
        'model' => $model,
        'rajal' => $rajal,
    ]) ?>

</div>
