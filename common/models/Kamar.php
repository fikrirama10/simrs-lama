<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kamar".
 *
 * @property int $id
 * @property string $namaruangan
 * @property int $idkelas
 * @property int $status
 *
 * @property Kelas $kelas
 */
class Kamar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kamar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idkelas', 'status'], 'integer'],
            [['namaruangan'], 'string', 'max' => 50],
            [['idkelas'], 'exist', 'skipOnError' => true, 'targetClass' => Kelas::className(), 'targetAttribute' => ['idkelas' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'namaruangan' => 'Namaruangan',
            'idkelas' => 'Idkelas',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasOne(Kelas::className(), ['id' => 'idkelas']);
    }
}
