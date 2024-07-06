<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pelab".
 *
 * @property int $id
 * @property string $tgl
 * @property string $rm
 * @property int $jenispemeriksaan
 * @property string $jamdiambil
 * @property string $jamhasil
 */
class Pelab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pelab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl', 'jamdiambil', 'jamhasil'], 'safe'],
            [['jenispemeriksaan'], 'integer'],
            [['rm'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tgl' => 'Tgl',
            'rm' => 'Rm',
            'jenispemeriksaan' => 'Jenispemeriksaan',
            'jamdiambil' => 'Jamdiambil',
            'jamhasil' => 'Jamhasil',
        ];
    }
}
