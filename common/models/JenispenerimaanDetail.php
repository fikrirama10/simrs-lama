<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jenispenerimaan_detail".
 *
 * @property int $id
 * @property int $idpenerimaan
 * @property string $namapenerimaan
 *
 * @property Jenispenerimaan $penerimaan
 */
class JenispenerimaanDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jenispenerimaan_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpenerimaan'], 'integer'],
            [['namapenerimaan'], 'string', 'max' => 50],
            [['idpenerimaan'], 'exist', 'skipOnError' => true, 'targetClass' => Jenispenerimaan::className(), 'targetAttribute' => ['idpenerimaan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idpenerimaan' => 'Idpenerimaan',
            'namapenerimaan' => 'Namapenerimaan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPenerimaan()
    {
        return $this->hasOne(Jenispenerimaan::className(), ['id' => 'idpenerimaan']);
    }
}
