<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DokumenKategori */

$this->title = 'Create Dokumen Kategori';
$this->params['breadcrumbs'][] = ['label' => 'Dokumen Kategoris', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dokumen-kategori-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
