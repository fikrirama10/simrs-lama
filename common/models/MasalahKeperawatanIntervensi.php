<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "masalah_keperawatan_intervensi".
 *
 * @property int $id
 * @property int $iddiagnosis
 * @property string $intervensi
 * @property string $kode
 *
 * @property MasalahKeperawatanDiagnosa $diagnosis
 */
class MasalahKeperawatanIntervensi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'masalah_keperawatan_intervensi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iddiagnosis'], 'integer'],
            [['intervensi', 'kode'], 'string', 'max' => 50],
            [['iddiagnosis'], 'exist', 'skipOnError' => true, 'targetClass' => MasalahKeperawatanDiagnosa::className(), 'targetAttribute' => ['iddiagnosis' => 'id']],
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
            'intervensi' => 'Intervensi',
            'kode' => 'Kode',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnosis()
    {
        return $this->hasOne(MasalahKeperawatanDiagnosa::className(), ['id' => 'iddiagnosis']);
    }
}
