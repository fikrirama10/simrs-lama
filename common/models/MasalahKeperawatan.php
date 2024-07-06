<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "masalah_keperawatan".
 *
 * @property int $id
 * @property int $idrawat
 * @property string $no_rekmed
 * @property string $tgl
 * @property int $user
 * @property int $idkategori
 * @property int $idsub
 * @property int $iddiagnosis
 * @property int $idtindakan
 * @property string $tindakan
 * @property string $keterangan
 */
class MasalahKeperawatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'masalah_keperawatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrawat', 'user', 'idkategori', 'idsub', 'iddiagnosis', 'idtindakan'], 'integer'],
            [['tgl'], 'safe'],
            [['tindakan', 'keterangan'], 'string'],
            [['no_rekmed'], 'string', 'max' => 50],
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
            'no_rekmed' => 'No Rekmed',
            'tgl' => 'Tgl',
            'user' => 'User',
            'idkategori' => 'Idkategori',
            'idsub' => 'Idsub',
            'iddiagnosis' => 'Iddiagnosis',
            'idtindakan' => 'Idtindakan',
            'tindakan' => 'Ket Lainnya',
            'keterangan' => 'Keterangan',
        ];
    }
	
	public function getDiagnosis()
    {
        return $this->hasOne(MasalahKeperawatanDiagnosa::className(), ['id' => 'iddiagnosis']);
    }
	
	public function getSubdiagnosis()
    {
        return $this->hasOne(MasalahKeperawatanTindakan::className(), ['id' => 'idtindakan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategori()
    {
        return $this->hasOne(MasalahKeperawatanKategori::className(), ['id' => 'idkategori']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSub()
    {
        return $this->hasOne(MasalahKeperawatanSub::className(), ['id' => 'idsub']);
    }
}
