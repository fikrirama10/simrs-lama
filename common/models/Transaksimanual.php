<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transaksimanual".
 *
 * @property int $id
 * @property string $idtrx
 * @property string $nama
 * @property string $alamat
 * @property int $usia
 * @property string $tanggal
 * @property int $status
 */
class Transaksimanual extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksimanual';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alamat'], 'string'],
            [['usia', 'status'], 'integer'],
            [['tanggal'], 'safe'],
            [['idtrx', 'nama'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idtrx' => 'Idtrx',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'usia' => 'Usia',
            'tanggal' => 'Tanggal',
            'status' => 'Status',
        ];
    }
}
