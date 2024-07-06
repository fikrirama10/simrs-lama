<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "masalah_keperawatan_diagnosa".
 *
 * @property int $id
 * @property string $kode
 * @property int $idsubkat
 * @property string $diagnosis
 * @property string $keterangan
 *
 * @property MasalahKeperawatanSub $subkat
 * @property MasalahKeperawatanTindakan[] $masalahKeperawatanTindakans
 */
class MasalahKeperawatanDiagnosa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'masalah_keperawatan_diagnosa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idsubkat'], 'integer'],
            [['diagnosis'], 'string'],
            [['kode', 'keterangan'], 'string', 'max' => 50],
            [['idsubkat'], 'exist', 'skipOnError' => true, 'targetClass' => MasalahKeperawatanSub::className(), 'targetAttribute' => ['idsubkat' => 'id']],
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
            'idsubkat' => 'Idsubkat',
            'diagnosis' => 'Diagnosis',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubkat()
    {
        return $this->hasOne(MasalahKeperawatanSub::className(), ['id' => 'idsubkat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMasalahKeperawatanTindakans()
    {
        return $this->hasMany(MasalahKeperawatanTindakan::className(), ['iddiagnosis' => 'id']);
    }
}
