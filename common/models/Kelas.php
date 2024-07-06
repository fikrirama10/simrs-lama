<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kelas".
 *
 * @property int $id
 * @property string $namakelas
 * @property string $tarif_hari
 */
class Kelas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kelas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tarif_hari'], 'number'],
            [['namakelas'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'namakelas' => 'Namakelas',
            'tarif_hari' => 'Tarif Hari',
        ];
    }
	public function getKelas()
    {
        return $this->hasOne(Kelas::className(), ['id' => 'idkelas']);
    }
}
