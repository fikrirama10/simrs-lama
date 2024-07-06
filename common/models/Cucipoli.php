<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cucipoli".
 *
 * @property int $id
 * @property string $petugas
 * @property int $idpoli
 * @property string $tanggal
 * @property int $patuh
 * @property int $validator
 */
class Cucipoli extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $jumlah;
	public $Cnt;
    public static function tableName()
    {
        return 'cucipoli';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpoli', 'patuh', 'validator'], 'integer'],
            [['tanggal'], 'safe'],
            [['petugas'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'petugas' => 'Petugas',
            'idpoli' => 'Idpoli',
            'tanggal' => 'Tanggal',
            'patuh' => 'Patuh',
            'validator' => 'Validator',
        ];
    }
	 public function getPoli()
    {
        return $this->hasOne(Poli::className(), ['id' => 'idpoli']);
    }
}
