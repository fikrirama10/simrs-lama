<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rmugd".
 *
 * @property int $id
 * @property string $tanggal
 * @property string $no_rekmed
 * @property string $diagnosa
 * @property int $df
 * @property string $jampermintaan
 * @property string $jamdatang
 * @property int $sesuai
 */
class Rmugd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	 public $jumlah;
	public $Cnt;
    public static function tableName()
    {
        return 'rmugd';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal', 'jampermintaan', 'jamdatang'], 'safe'],
            [['sesuai'], 'integer'],
            [['df','no_rekmed'], 'string', 'max' => 50],
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
            'tanggal' => 'Tanggal',
            'no_rekmed' => 'No Rekmed',
            'diagnosa' => 'Diagnosa',
            'df' => 'Df',
            'jampermintaan' => 'Jampermintaan',
            'jamdatang' => 'Jamdatang',
            'sesuai' => 'Sesuai',
        ];
    }
		public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'no_rekmed']);
    }
}
