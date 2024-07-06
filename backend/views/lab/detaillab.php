
<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Lab;
use common\models\Subkattindakanlab;
use common\models\Kattindakanlab;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\LabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$lab = Lab::find()->groupBy(['idrawat'])->orderBy(['tanggal_req'=>SORT_DESC])->all();
$this->title = 'Labs';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    // 'showPageSummary' => true,
    'pjax' => true,
    'striped' => true,
    'hover' => true,
    'panel' => ['type' => 'primary', 'heading' => 'Hasil Lab'],
    'toggleDataContainer' => ['class' => 'btn-group mr-2'],
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        [
             'attribute' => 'Pemeriksaan', 
            'width' => '250px',
            'value' => function ($model, $key, $index, $widget) { 
                return $model->katt->nama;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Kattindakanlab::find()->orderBy('nama')->asArray()->all(), 'id', 'nama'), 
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Any supplier'],
            'group' => true,  // enable grouping
        ],
        [
            'attribute' => 'Jenis Pemeriksaan', 
            'width' => '250px',
            'value' => function ($model, $key, $index, $widget) { 
                return $model->kat->nama;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Subkattindakanlab::find()->orderBy('nama')->asArray()->all(), 'id', 'nama'), 
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Any category']
        ],
        [
                        'attribute' => 'Hasil',
                        'format' => 'raw',
                        'value' => function ($model, $key, $index) { 
                            return $model->hasil;
                        },
                    ],

[
                        'attribute' => 'Satuan',
                        'format' => 'raw',
                        'value' => function ($model, $key, $index) { 
                            return $model->kat->satuan;
                        },
                    ],       

[
                        'attribute' => 'Nilai Rujukan',
                        'format' => 'raw',
                        'value' => function ($model, $key, $index) { 
                            if($model->pasien->jenis_kelamin == 'L'){
                                return $model->kat->l;
                            }else{
                                return $model->kat->p;
                            }
                        },
                    ],              
    ],

]);?>