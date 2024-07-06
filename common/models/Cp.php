<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cp".
 *
 * @property int $id
 * @property string $tanggal
 * @property string $no_rekmed
 * @property string $diagnosa
 * @property int $patuh
 * @property int $validator
 */
class Cp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
  	 */
	public $jumlah;
	public $Cnt;
	 public static function tableName()
    {
        return 'cp';
    }

    /**
     * {@inheritdoc}
     */
	 
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['diagnosa'], 'string'],
            [['patuh', 'validator'], 'integer'],
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
            'no_rekmed' => 'No Rekmed',
            'diagnosa' => 'Diagnosa',
            'patuh' => 'Patuh',
            'validator' => 'Validator',
        ];
    }
	public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }	
}
