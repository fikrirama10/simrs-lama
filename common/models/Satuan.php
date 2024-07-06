<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "satuan".
 *
 * @property int $id
 * @property string $satuan
 * @property string $ket
 */
class Satuan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'satuan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['satuan', 'ket'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'satuan' => 'Satuan',
            'ket' => 'Ket',
        ];
    }
}
