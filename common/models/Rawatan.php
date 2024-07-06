<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rawatan".
 *
 * @property int $id
 * @property string $idrawat
 * @property string $no_rekmed
 * @property string $tgldaftar
 * @property int $jenisbayar
 * @property int $totalbiaya
 */
class Rawatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rawatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgldaftar'], 'safe'],
            [['jenisbayar', 'totalbiaya'], 'integer'],
            [['idrawat', 'no_rekmed'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idrawat' => 'Idrawat',
            'no_rekmed' => 'No Rekmed',
            'tgldaftar' => 'Tgldaftar',
            'jenisbayar' => 'Jenisbayar',
            'totalbiaya' => 'Totalbiaya',
        ];
    }
}
