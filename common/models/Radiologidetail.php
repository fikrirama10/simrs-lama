<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "radiologidetail".
 *
 * @property int $id
 * @property string $no_rekmed
 * @property string $idrawat
 * @property int $idpengirim
 * @property int $idpemeriksa
 * @property string $hasil
 * @property string $idrad
 * @property string $kesan
 */
class Radiologidetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'radiologidetail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idjenisrad','status','idpemeriksa','tem'], 'integer'],
            [['hasil', 'kesan','klinis','nofoto'], 'string'],
            [['idrad'], 'string', 'max' => 50],
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
            'idrawat' => 'Idrawat',
            'idpengirim' => 'Idpengirim',
            'idpemeriksa' => 'Idpemeriksa',
            'hasil' => 'Hasil',
            'idrad' => 'Idrad',
            'kesan' => 'Kesan',
        ];
    }
	public function getDrad()
    {
        return $this->hasOne(Dafrad::className(), ['id' => 'idjenisrad']);
    }
	public function getRad()
    {
        return $this->hasOne(Radiologi::className(), ['idrad' => 'idrad']);
    }
	public function getPemeriksa()
    {
        return $this->hasOne(User::className(), ['id' => 'idpemeriksa']);
    }
}
