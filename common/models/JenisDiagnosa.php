<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jenis_diagnosa".
 *
 * @property int $id
 * @property string $jenisdiagnosa
 */
class JenisDiagnosa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jenis_diagnosa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenisdiagnosa'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenisdiagnosa' => 'Jenisdiagnosa',
        ];
    }
}
