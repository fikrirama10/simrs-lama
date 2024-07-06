<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hermatologi".
 *
 * @property int $id
 * @property int $metode
 * @property string $idrawat
 * @property string $rm
 * @property int $idtindakan
 * @property string $hasil
 * @property string $rujukan
 * @property string $satuan
 * @property int $idkatindakan
 */
class Pemriklab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pemriklab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['labid', 'idtindakan', 'idjenisp','idkatindakan'], 'integer'],
            [['idrawat', 'rm', 'hasil','nama','kodelab', 'satuan'], 'string', 'max' => 50],
            [['rujukan'], 'string', 'max' => 225],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'metode' => 'Metode',
            'idrawat' => 'Idrawat',
            'rm' => 'Rm',
            'idtindakan' => 'Idtindakan',
            'hasil' => 'Hasil',
            'rujukan' => 'Rujukan',
            'satuan' => 'Satuan',
            'idkatindakan' => 'Idkatindakan',
        ];
    }
	 public function getKat()
    {
        return $this->hasOne(Subkattindakanlab::className(), ['id' => 'idkatindakan']);
    }

	 public function getKatt()
    {
        return $this->hasOne(Kattindakanlab::className(), ['id' => 'idtindakan']);
    }
	public function getJenis()
    {
        return $this->hasOne(Daflab::className(), ['id' => 'idjenisp']);
    }

        public function getPasien()
    {
        return $this->hasOne(Pasien::className(), ['no_rekmed' => 'rm']);
    }

}
