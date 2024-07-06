<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jenisrawat".
 *
 * @property int $id
 * @property string $jenisrawat
 * @property string $ket
 *
 * @property Rawatjalan[] $rawatjalans
 */
class Jenisrawat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jenisrawat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenisrawat', 'ket'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenisrawat' => 'Jenisrawat',
            'ket' => 'Ket',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRawatjalans()
    {
        return $this->hasMany(Rawatjalan::className(), ['idjenisrawat' => 'id']);
    }
}
