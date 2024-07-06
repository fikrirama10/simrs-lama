<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "diagnosa".
 *
 * @property int $id
 * @property string $kodediagnosa
 * @property string $diagnosa
 */
class Diagnosa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diagnosa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['diagnosa'], 'string'],
            [['kodediagnosa'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kodediagnosa' => 'Kodediagnosa',
            'diagnosa' => 'Diagnosa',
        ];
    }
}
