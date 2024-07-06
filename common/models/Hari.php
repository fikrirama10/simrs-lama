<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hari".
 *
 * @property integer $id
 * @property string $nama_hari
 *
 * @property Jadwaldokter[] $jadwaldokters
 */
class Hari extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hari';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_hari','ket'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_hari' => 'Nama Hari',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwaldokters()
    {
        return $this->hasMany(Jadwaldokter::className(), ['idhari' => 'id']);
    }
}
