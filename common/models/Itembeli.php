<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "itembeli".
 *
 * @property int $id
 * @property int $nofaktur
 * @property int $idobat
 * @property int $jumlah
 * @property int $idsatuan
 */
class Itembeli extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'itembeli';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			
            [['nofaktur','dari'],'string'],
            [['nofaktur','status', 'idobat', 'jumlah', 'idsatuan','harga'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nofaktur' => 'Nofaktur',
            'idobat' => 'Idobat',
            'jumlah' => 'Jumlah',
            'idsatuan' => 'Idsatuan',
        ];
    }
	public function getObat()
    {
        return $this->hasOne(Obat::className(), ['id' => 'idobat']);
    }
	public function getFaktur()
    {
        return $this->hasOne(Pembelianapotek::className(), ['nofaktur' => 'nofaktur']);
    }
	public function getNobat()
    {
        return $this->hasOne(Obat::className(), ['id' => 'idobat']);
    }
	public function getSatu()
    {
        return $this->hasOne(Satuan::className(), ['id' => 'idsatuan']);
    }
}
