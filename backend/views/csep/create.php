<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Csep */

$this->title = 'Create Csep';
$this->params['breadcrumbs'][] = ['label' => 'Cseps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="csep-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pasien' => $pasien,
    ]) ?>

</div>
