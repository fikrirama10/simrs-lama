<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "prosm".
 *
 * @property int $id
 * @property int $validator
 * @property string $tanggal
 * @property string $no_rekmed
 * @property string $diagnosa
 * @property int $sm
 * @property string $df
 */
class Prosm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $jumlah;
	public $Cnt;
    public static function tableName()
    {
        return 'prosm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['validator', 'sm'], 'integer'],
            [['tanggal'], 'safe'],
            [['no_rekmed', 'df'], 'string', 'max' => 50],
            [['diagnosa'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'validator' => 'Validator',
            'tanggal' => 'Tanggal',
            'no_rekmed' => 'No Rekmed',
            'diagnosa' => 'Diagnosa',
            'sm' => 'Sm',
            'df' => 'Df',
        ];
    }
	public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }	
}
