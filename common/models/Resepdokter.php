<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "resepdokter".
 *
 * @property int $id
 * @property int $idrawat
 * @property string $kodeobat
 * @property string $dosis
 * @property string $ket
 * @property int $jumlah
 */
class Resepdokter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resepdokter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'jumlah','idsatuan','iddokter'], 'integer'],
            [['idrawat','ket','no_rekmed','takaran','diminum','khasiat'], 'string'],
			[['tanggal'], 'safe'],
            [['kodeobat', 'dosis'], 'string', 'max' => 50],
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
            'kodeobat' => 'Kodeobat',
            'dosis' => 'Dosis',
            'ket' => 'Ket',
            'jumlah' => 'Jumlah',
        ];
    }
	public function getObat()
    {
        return $this->hasOne(Obat::className(), ['id' => 'kodeobat']);
    }
	public function getRawatja()
    {
        return $this->hasOne(Rawatjalan::className(), ['idrawat' => 'idrawat']);
    }
}
