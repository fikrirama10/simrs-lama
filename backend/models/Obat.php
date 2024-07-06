<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "obat".
 *
 * @property int $id
 * @property string $noobat
 * @property string $namaobat
 * @property string $kadaluarsa
 * @property int $idsuplier
 * @property string $harga
 */
class Obat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'obat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kadaluarsa'], 'safe'],
            [['idsuplier'], 'integer'],
            [['harga'], 'number'],
            [['noobat', 'namaobat'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'noobat' => 'Noobat',
            'namaobat' => 'Namaobat',
            'kadaluarsa' => 'Kadaluarsa',
            'idsuplier' => 'Idsuplier',
            'harga' => 'Harga',
        ];
    }
}
