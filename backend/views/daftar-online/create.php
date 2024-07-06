<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Daftaronline */

$this->title = 'Create Daftaronline';
$this->params['breadcrumbs'][] = ['label' => 'Daftaronlines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="daftaronline-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
