<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Jenispengaduan */

$this->title = 'Create Jenispengaduan';
$this->params['breadcrumbs'][] = ['label' => 'Jenispengaduans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenispengaduan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
