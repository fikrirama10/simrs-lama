<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Trxmanual */

$this->title = 'Create Trxmanual';
$this->params['breadcrumbs'][] = ['label' => 'Trxmanuals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trxmanual-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
