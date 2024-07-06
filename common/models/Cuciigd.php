<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cuciigd".
 *
 * @property int $id
 * @property string $tanggal
 * @property string $petugas
 * @property int $dinas
 * @property int $patuh
 * @property int $validator
 */
class Cuciigd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $jumlah;
	public $Cnt;
    public static function tableName()
    {
        return 'cuciigd';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['dinas', 'patuh', 'validator'], 'integer'],
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
            'tanggal' => 'Tanggal',
            'petugas' => 'petugas',
            'dinas' => 'Dinas',
            'patuh' => 'Patuh',
            'validator' => 'Validator',
        ];
    }
	public function getDinasa()
    {
        return $this->hasOne(Dinas::className(), ['id' => 'dinas']);
    }
}
