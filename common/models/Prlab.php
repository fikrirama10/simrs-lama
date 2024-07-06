<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "prlab".
 *
 * @property int $id
 * @property int $idjenis
 * @property string $tanggal
 * @property string $no_rekmed
 * @property string $jamdiambil
 * @property string $jamhasil
 * @property string $durasi
 */
class Prlab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prlab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idjenis','tepat','dari'], 'integer'],
            [['tanggal', 'jamdiambil', 'jamhasil'], 'safe'],
            [['no_rekmed', 'durasi'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idjenis' => 'Idjenis',
            'tanggal' => 'Tanggal',
            'no_rekmed' => 'No Rekmed',
            'jamdiambil' => 'Jamdiambil',
            'jamhasil' => 'Jamhasil',
            'durasi' => 'Durasi',
        ];
    }
	public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }
	public function getPeriksa()
    {
        return $this->hasOne(Daflab::className(), ['id' => 'idjenis']);
    }
}
