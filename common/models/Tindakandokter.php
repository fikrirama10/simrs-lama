<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tindakandokter".
 *
 * @property integer $id
 * @property string $kode_rawat
 * @property integer $idtindakan
 * @property integer $tarif
 * @property integer $penindak
 * @property string $ditindakoleh
 */
class Tindakandokter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tindakandokter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idtindakan', 'penindak'], 'integer'],
			[['tgl'], 'safe'],
            [['kode_rawat','tarif', 'ditindakoleh','tindakann'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode_rawat' => 'Kode Rawat',
            'idtindakan' => 'Tindakan Dokter',
            'tarif' => 'Tarif',
            'penindak' => 'Penindak',
            'ditindakoleh' => 'Ditindakoleh',
        ];
    }
	 public function getTindakandokter()
    {
        return $this->hasOne(Tindakan::className(), ['id' => 'idtindakan']);
    }
	public function getDokter()
    {
        return $this->hasOne(Dokter::className(), ['id' => 'penindak']);
    }
	
	public function getRawatja()
    {
        return $this->hasOne(Rawatjalan::className(), ['idrawat' => 'kode_rawat']);
    }
    public function getJenis()
    {
        return $this->hasOne(Jenisrawat::className(), ['id' => 'idtkp']);
    }
}
