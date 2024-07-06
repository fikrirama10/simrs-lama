<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Pengeluaran */

$this->title = 'Create Pengeluaran';
$this->params['breadcrumbs'][] = ['label' => 'Pengeluarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengeluaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
