<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tindakan".
 *
 * @property integer $id
 * @property integer $idpoli
 * @property string $namatindakan
 * @property string $tarif
 * @property string $ket
 */
class Tindakan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tindakan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idpoli'], 'integer'],
            [['tarif'], 'number'],
            [['namatindakan', 'ket'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idpoli' => 'Idpoli',
            'namatindakan' => 'Namatindakan',
            'tarif' => 'Tarif',
            'ket' => 'Ket',
        ];
    }
}
