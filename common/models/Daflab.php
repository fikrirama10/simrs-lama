<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "daflab".
 *
 * @property int $id
 * @property string $namapemeriksaan
 * @property string $tarif
 * @property string $ket
 */
class Daflab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'daflab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tarif'], 'number'],
            [['namapemeriksaan', 'ket'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'namapemeriksaan' => 'Namapemeriksaan',
            'tarif' => 'Tarif',
            'ket' => 'Ket',
        ];
    }
}
