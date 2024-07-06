<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Jadwaloprasi */

$this->title = 'Create Jadwaloprasi';
$this->params['breadcrumbs'][] = ['label' => 'Jadwaloprasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jadwaloprasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
