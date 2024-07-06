<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pradiologi".
 *
 * @property int $id
 * @property string $tanggal
 * @property string $jamdiambil
 * @property string $jamhasil
 * @property string $durasi
 * @property int $jenispemeriksaan
 * @property string $no_rekmed
 */
class Pradiologi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pradiologi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal', 'jamdiambil', 'jamhasil', 'durasi'], 'safe'],
            [['jenispemeriksaan','tepat','dari'], 'integer'],
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
            'tanggal' => 'Tanggal',
            'jamdiambil' => 'Jamdiambil',
            'jamhasil' => 'Jamhasil',
            'durasi' => 'Durasi',
            'jenispemeriksaan' => 'Jenispemeriksaan',
            'no_rekmed' => 'No Rekmed',
        ];
    }
	public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }
	public function getPeriksa()
    {
        return $this->hasOne(Dafrad::className(), ['id' => 'jenispemeriksaan']);
    }
}
