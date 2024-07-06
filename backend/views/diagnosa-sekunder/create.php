<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PemeriksaanUgddiagsekunder */

$this->title = 'Tambah Diagnosa Sekunder';
$this->params['breadcrumbs'][] = ['label' => 'Pemeriksaan Ugddiagsekunders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemeriksaan-ugddiagsekunder-create">

   

    <?= $this->render('_form', [
        'model' => $model,
		'rawat' => $rawat,
    ]) ?>

</div>
