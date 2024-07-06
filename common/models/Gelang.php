<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gelang".
 *
 * @property int $id
 * @property int $validator
 * @property string $tanggal
 * @property string $no_rekmed
 * @property string $diagnosa
 * @property string $df
 * @property string $kepatuhan
 */
class Gelang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $jumlah;
	public $Cnt;
    public static function tableName()
    {
        return 'gelang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['validator','kepatuhan'], 'integer'],
            [['tanggal','df'], 'safe'],
            [['no_rekmed'], 'string', 'max' => 50],
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
            'df' => 'Df',
            'kepatuhan' => 'Kepatuhan',
        ];
    }
	public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }
}
