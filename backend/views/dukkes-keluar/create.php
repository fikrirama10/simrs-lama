<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DukkesKeluar */

$this->title = 'Pengeluaran Obat / Alkes Dukkes';
$this->params['breadcrumbs'][] = ['label' => 'Dukkes Keluars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dukkes-keluar-create box box-body">

    <h1><?= Html::encode($this->title) ?></h1>
	<hr>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
