<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Pengaduan */

$this->title = 'Create Pengaduan';
$this->params['breadcrumbs'][] = ['label' => 'Pengaduans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengaduan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
