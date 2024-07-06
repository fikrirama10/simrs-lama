<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Tableicd */

$this->title = 'Create Tableicd';
$this->params['breadcrumbs'][] = ['label' => 'Tableicds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tableicd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
