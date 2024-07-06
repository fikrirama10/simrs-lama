<?php

use yii\helpers\Html;
use common\models\Pekerjaan;

/* @var $this yii\web\View */
/* @var $model common\models\Pasisen */

//$this->title = 'Create Pasisen';
$this->params['breadcrumbs'][] = ['label' => 'Pasisens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasisen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form2', [
        'model' => $model,
        'pekerjaan' => $pekerjaan,
    ]) ?>

</div>
