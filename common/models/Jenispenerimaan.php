<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jenispenerimaan".
 *
 * @property int $id
 * @property string $jenispenerimaan
 *
 * @property JenispenerimaanDetail[] $jenispenerimaanDetails
 */
class Jenispenerimaan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jenispenerimaan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenispenerimaan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenispenerimaan' => 'Jenispenerimaan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenispenerimaanDetails()
    {
        return $this->hasMany(JenispenerimaanDetail::className(), ['idpenerimaan' => 'id']);
    }
}
