<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "okdokter".
 *
 * @property int $id
 * @property int $idok
 * @property int $idperson
 * @property string $status
 */
class Okdokter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'okdokter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idok', 'idperson'], 'integer'],
            [['status'], 'string'],
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
            'idperson' => 'Idperson',
            'status' => 'Status',
        ];
    }
}
