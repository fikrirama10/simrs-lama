<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "daftaronline".
 *
 * @property int $id
 * @property int $idpoli
 * @property int $kuota
 * @property int $user
 * @property string $tanggal
 */
class Daftaronline extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'daftaronline';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpoli', 'kuota', 'user','status',], 'integer'],
            [['tanggal','waktu',], 'safe'],
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
            'kuota' => 'Kuota',
            'user' => 'User',
            'tanggal' => 'Tanggal',
        ];
    }
	    public function getPolie()
    {
        return $this->hasOne(Poli::className(), ['id' => 'idpoli']);
    }

}
