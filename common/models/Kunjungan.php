<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kunjungan".
 *
 * @property int $id
 * @property string $no_rekmed
 * @property int $idpekerjaan
 * @property string $sebagai
 * @property string $created_at
 * @property string $idrawat
 */
class Kunjungan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kunjungan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpekerjaan'], 'integer'],
            [['created_at'], 'safe'],
            [['no_rekmed', 'sebagai', 'idrawat'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_rekmed' => 'No Rekmed',
            'idpekerjaan' => 'Idpekerjaan',
            'sebagai' => 'Sebagai',
            'created_at' => 'Created At',
            'idrawat' => 'Idrawat',
        ];
    }
}
