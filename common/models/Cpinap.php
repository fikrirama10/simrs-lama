<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cpinap".
 *
 * @property int $id
 * @property string $no_rekmed
 * @property string $diagnosa
 * @property string $tenagakesehatan
 * @property int $patuh
 * @property int $validator
 * @property string $tanggal
 */
class Cpinap extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $jumlah;
	public $Cnt;
    public static function tableName()
    {
        return 'cpinap';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['diagnosa', 'tenagakesehatan'], 'string'],
            [['patuh', 'validator'], 'integer'],
            [['tanggal'], 'safe'],
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
            'diagnosa' => 'Diagnosa',
            'tenagakesehatan' => 'Tenagakesehatan',
            'patuh' => 'Patuh',
            'validator' => 'Validator',
            'tanggal' => 'Tanggal',
        ];
    }
	public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }	
}
