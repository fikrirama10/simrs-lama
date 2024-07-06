<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tindakan".
 *
 * @property int $id
 * @property int $idpoli
 * @property string $namatindakan
 * @property string $kattindakan
 * @property string $tarif
 * @property string $ket
 */
class Tindakan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tindakan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpoli'], 'integer'],
            [['tarif'], 'number'],
            [['namatindakan', 'kattindakan', 'ket'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idpoli' => 'Idpoli',
            'namatindakan' => 'Namatindakan',
            'kattindakan' => 'Kattindakan',
            'tarif' => 'Tarif',
            'ket' => 'Ket',
        ];
    }
}
