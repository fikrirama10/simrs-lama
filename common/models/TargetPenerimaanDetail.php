<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "target_penerimaan_detail".
 *
 * @property int $id
 * @property string $kodepagu
 * @property string $nilaipagu
 * @property int $targetpagu
 * @property string $kodetarget
 * @property int $idpenerimaan
 */
class TargetPenerimaanDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'target_penerimaan_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['targetpagu','nilaipagu'], 'number'],
            [[ 'idpenerimaan'], 'integer'],
            [['kodepagu'], 'string', 'max' => 100],
            [['kodetarget'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kodepagu' => 'Kodepagu',
            'nilaipagu' => 'Nilaipagu',
            'targetpagu' => 'Targetpagu',
            'kodetarget' => 'Kodetarget',
            'idpenerimaan' => 'Idpenerimaan',
        ];
    }
}
