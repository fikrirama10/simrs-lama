<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transferpasien".
 *
 * @property int $id
 * @property int $validator
 * @property string $no_rekmed
 * @property string $tanggal
 * @property string $diagnosa
 * @property string $df
 * @property int $kepatuhan
 */
class Transferpasien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $jumlah;
	public $Cnt;
    public static function tableName()
    {
        return 'transferpasien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['validator', 'kepatuhan'], 'integer'],
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
            'no_rekmed' => 'No Rekmed',
            'tanggal' => 'Tanggal',
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
