<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
 $diff =strtotime($model->jamhasil)-strtotime($model->jamdiambil);
 $hours= floor($diff/(60));
                $mins= floor(($diff-($hours*60*60))/60);

/* @var $this yii\web\View */
/* @var $model common\models\Pradiologi */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pradiologis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pradiologi-view">
	
	<?= $hours;?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tanggal',
            'jamdiambil',
            'jamhasil',
            'durasi',
            'jenispemeriksaan',
            'no_rekmed',
        ],
    ]) ?>

</div>
