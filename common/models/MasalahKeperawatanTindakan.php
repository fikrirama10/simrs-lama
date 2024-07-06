<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "masalah_keperawatan_tindakan".
 *
 * @property int $id
 * @property int $iddiagnosis
 * @property int $idkategori
 * @property int $idsub
 * @property string $tindakan
 * @property string $ket
 *
 * @property MasalahKeperawatanDiagnosa $diagnosis
 * @property MasalahKeperawatanKategori $kategori
 * @property MasalahKeperawatanSub $sub
 */
class MasalahKeperawatanTindakan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'masalah_keperawatan_tindakan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iddiagnosis', 'idkategori', 'idsub'], 'integer'],
            [['tindakan', 'ket'], 'string'],
            [['iddiagnosis'], 'exist', 'skipOnError' => true, 'targetClass' => MasalahKeperawatanDiagnosa::className(), 'targetAttribute' => ['iddiagnosis' => 'id']],
            [['idkategori'], 'exist', 'skipOnError' => true, 'targetClass' => MasalahKeperawatanKategori::className(), 'targetAttribute' => ['idkategori' => 'id']],
            [['idsub'], 'exist', 'skipOnError' => true, 'targetClass' => MasalahKeperawatanSub::className(), 'targetAttribute' => ['idsub' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'iddiagnosis' => 'Iddiagnosis',
            'idkategori' => 'Idkategori',
            'idsub' => 'Idsub',
            'tindakan' => 'Detail Diagnosis',
            'ket' => 'Ket',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnosis()
    {
        return $this->hasOne(MasalahKeperawatanDiagnosa::className(), ['id' => 'iddiagnosis']);
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
