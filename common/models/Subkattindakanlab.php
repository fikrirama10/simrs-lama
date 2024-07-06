<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subkattindakanlab".
 *
 * @property int $id
 * @property int $idkat
 * @property string $nama
 * @property string $ket
 * @property int $status
 *
 * @property Kattindakanlab $kat
 */
class Subkattindakanlab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subkattindakanlab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idkat', 'status'], 'integer'],
            [['ket'], 'string'],
            [['nama'], 'string', 'max' => 50],
            [['idkat'], 'exist', 'skipOnError' => true, 'targetClass' => Kattindakanlab::className(), 'targetAttribute' => ['idkat' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idkat' => 'Idkat',
            'nama' => 'Nama',
            'ket' => 'Ket',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKat()
    {
        return $this->hasOne(Kattindakanlab::className(), ['id' => 'idkat']);
    }
}
