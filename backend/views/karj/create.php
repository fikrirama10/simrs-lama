<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Gelang */

$this->title = 'Kelengkapan Assesmen Resiko Jatuh';
$this->params['breadcrumbs'][] = ['label' => 'Gelangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gelang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
