<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "okperawatan".
 *
 * @property int $id
 * @property string $idok
 * @property int $idperawat
 * @property int $status
 */
class Okperawatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'okperawatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idperawat', 'status'], 'integer'],
            [['idok'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idok' => 'Idok',
            'idperawat' => 'Idperawat',
            'status' => 'Status',
        ];
    }
}
