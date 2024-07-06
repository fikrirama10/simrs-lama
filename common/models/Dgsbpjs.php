<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dgsbpjs".
 *
 * @property int $id
 * @property string $kode
 * @property int $ket
 */
class Dgsbpjs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dgsbpjs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ket'], 'integer'],
            [['kode'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'ket' => 'Ket',
        ];
    }
}
