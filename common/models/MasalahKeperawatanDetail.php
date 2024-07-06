<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "masalah_keperawatan_detail".
 *
 * @property int $id
 * @property int $idrawat
 * @property int $idmasalah
 * @property int $idkategori
 * @property int $idsub
 * @property int $iddiagnosis
 * @property int $idsubdiagnosis
 * @property string $subdiagnosis
 * @property int $idintervensi
 * @property string $ket
 */
class MasalahKeperawatanDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'masalah_keperawatan_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrawat', 'idmasalah', 'idkategori', 'idsub', 'iddiagnosis', 'idsubdiagnosis', 'idintervensi'], 'integer'],
            [['subdiagnosis', 'ket'], 'string', 'max' => 50],
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
            'idmasalah' => 'Idmasalah',
            'idkategori' => 'Idkategori',
            'idsub' => 'Idsub',
            'iddiagnosis' => 'Iddiagnosis',
            'idsubdiagnosis' => 'Idsubdiagnosis',
            'subdiagnosis' => 'Subdiagnosis',
            'idintervensi' => 'Idintervensi',
            'ket' => 'Ket',
        ];
    }
	public function getIntervensi()
    {
        return $this->hasOne(MasalahKeperawatanIntervensi::className(), ['id' => 'idintervensi']);
    }
}
