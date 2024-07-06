<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PemeriksaanRanap */

$this->title = 'Create Pemeriksaan Ranap';
$this->params['breadcrumbs'][] = ['label' => 'Pemeriksaan Ranaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemeriksaan-ranap-create">

  
    <?= $this->render('_form', [
        'model' => $model,
        'rajal' => $rajal,

    ]) ?>

</div>
