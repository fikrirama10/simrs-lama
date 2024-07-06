<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PemeriksaanawalRanap */

$this->title = 'Create Pemeriksaanawal Ranap';
$this->params['breadcrumbs'][] = ['label' => 'Pemeriksaanawal Ranaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemeriksaanawal-ranap-create">


    <?= $this->render('_form', [
        'model' => $model,
        'rajal' => $rajal,
    ]) ?>

</div>
