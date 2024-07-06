<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "suplier".
 *
 * @property int $id
 * @property string $namasuplier
 * @property string $alamat
 * @property string $nohp
 */
class Suplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'suplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alamat'], 'string'],
            [['namasuplier', 'nohp'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'namasuplier' => 'Namasuplier',
            'alamat' => 'Alamat',
            'nohp' => 'Nohp',
        ];
    }
}
