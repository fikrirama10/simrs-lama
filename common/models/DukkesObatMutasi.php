<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dukkes_obat_mutasi".
 *
 * @property int $id
 * @property int $idobat
 * @property string $jenismutasi
 * @property int $qty
 * @property string $tanggal
 * @property int $iduser
 * @property string $keterangan
 */
class DukkesObatMutasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dukkes_obat_mutasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idobat', 'qty', 'iduser'], 'integer'],
            [['jenismutasi', 'keterangan'], 'string'],
            [['tanggal'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idobat' => 'Idobat',
            'jenismutasi' => 'Jenismutasi',
            'qty' => 'Qty',
            'tanggal' => 'Tanggal',
            'iduser' => 'Iduser',
            'keterangan' => 'Keterangan',
        ];
    }
}
