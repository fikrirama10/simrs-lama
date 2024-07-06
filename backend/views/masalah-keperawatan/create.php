<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MasalahKeperawatan */

$this->title = 'Create Masalah Keperawatan';
$this->params['breadcrumbs'][] = ['label' => 'Masalah Keperawatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="masalah-keperawatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
