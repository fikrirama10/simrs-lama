<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "masalah_keperawatan_sub".
 *
 * @property int $id
 * @property int $idkategori
 * @property string $subkategori
 *
 * @property MasalahKeperawatanDiagnosa[] $masalahKeperawatanDiagnosas
 * @property MasalahKeperawatanKategori $kategori
 * @property MasalahKeperawatanTindakan[] $masalahKeperawatanTindakans
 */
class MasalahKeperawatanSub extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'masalah_keperawatan_sub';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idkategori'], 'integer'],
            [['subkategori'], 'string', 'max' => 50],
            [['idkategori'], 'exist', 'skipOnError' => true, 'targetClass' => MasalahKeperawatanKategori::className(), 'targetAttribute' => ['idkategori' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idkategori' => 'Idkategori',
            'subkategori' => 'Subkategori',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMasalahKeperawatanDiagnosas()
    {
        return $this->hasMany(MasalahKeperawatanDiagnosa::className(), ['idsubkat' => 'id']);
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
    public function getMasalahKeperawatanTindakans()
    {
        return $this->hasMany(MasalahKeperawatanTindakan::className(), ['idsub' => 'id']);
    }
}
