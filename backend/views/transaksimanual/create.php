<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Transaksimanual */

$this->title = 'Create Transaksimanual';
$this->params['breadcrumbs'][] = ['label' => 'Transaksimanuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksimanual-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
