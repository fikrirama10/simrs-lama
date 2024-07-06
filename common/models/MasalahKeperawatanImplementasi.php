<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "masalah_keperawatan_implementasi".
 *
 * @property int $id
 * @property int $idrawat
 * @property int $iduser
 * @property string $jam
 * @property string $tanggal
 * @property int $idimplementasi
 * @property string $implementasi
 * @property string $keterangan
 * @property int $idintervensi
 */
class MasalahKeperawatanImplementasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'masalah_keperawatan_implementasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrawat', 'iduser', 'idimplementasi', 'idintervensi'], 'integer'],
            [['jam', 'tanggal'], 'safe'],
            [['implementasi', 'keterangan'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idrawat' => 'Idrawat',
            'iduser' => 'Iduser',
            'jam' => 'Jam',
            'tanggal' => 'Tanggal',
            'idimplementasi' => 'Idimplementasi',
            'implementasi' => 'Implementasi',
            'keterangan' => 'Keterangan',
            'idintervensi' => 'Idintervensi',
        ];
    }
	public function getAsu()
    {
        return $this->hasOne(RencanaasuhanImplementasi::className(), ['id' => 'idimplementasi']);
    }
}
