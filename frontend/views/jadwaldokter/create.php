<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Jadwaldokter */

$this->title = 'Create Jadwaldokter';
$this->params['breadcrumbs'][] = ['label' => 'Jadwaldokters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jadwaldokter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
