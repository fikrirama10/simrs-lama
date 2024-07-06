<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dukker_temporary".
 *
 * @property int $id
 * @property string $kodetrx
 * @property int $idobat
 * @property int $qty
 * @property string $status
 */
class DukkerTemporary extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dukker_temporary';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idobat', 'qty'], 'integer'],
            [['status'], 'string'],
            [['kodetrx'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kodetrx' => 'Kodetrx',
            'idobat' => 'Idobat',
            'qty' => 'Qty',
            'status' => 'Status',
        ];
    }
	public function getObat()
    {
        return $this->hasOne(DukkesObat::className(), ['id' => 'idobat']);
    }
}
