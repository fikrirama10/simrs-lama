<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Dokumen */

$this->title = 'Create Dokumen';
$this->params['breadcrumbs'][] = ['label' => 'Dokumens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dokumen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
