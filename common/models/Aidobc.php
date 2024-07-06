<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "aidobc".
 *
 * @property int $id
 * @property string $no_rekmed
 * @property string $tanggal
 * @property int $cukurclipper
 * @property int $waktucukur
 * @property int $mandi
 * @property int $antibiotic
 * @property int $tdkinfeksi
 * @property string $kontrolgula
 * @property int $validator
 */
class Aidobc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aidobc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['cukurclipper','jumlah', 'waktucukur', 'mandi', 'antibiotic', 'tdkinfeksi', 'kontrolgula', 'validator'], 'integer'],
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
            'no_rekmed' => 'No Rekmed',
            'tanggal' => 'Tanggal',
            'cukurclipper' => 'Cukurclipper',
            'waktucukur' => 'Waktucukur',
            'mandi' => 'Mandi',
            'antibiotic' => 'Antibiotic',
            'tdkinfeksi' => 'Tdkinfeksi',
            'kontrolgula' => 'Kontrolgula',
            'validator' => 'Validator',
        ];
    }
	public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }
}
