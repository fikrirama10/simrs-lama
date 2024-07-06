<?php

use yii\helpers\Html;
use common\models\PermintaanBarang;
use yii\helpers\Url;
$permintaan = PermintaanBarang::find()->where(['<','status',4])->count();

/* @var $this yii\web\View */
/* @var $model common\models\PermintaanBarang */

$this->title = 'Create Permintaan Barang';
$this->params['breadcrumbs'][] = ['label' => 'Permintaan Barangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-body'>
    <h1><?= Html::encode($this->title) ?></h1>
	<hr>

<div class="permintaan-barang-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
