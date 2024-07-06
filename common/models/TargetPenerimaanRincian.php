<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "target_penerimaan_rincian".
 *
 * @property int $id
 * @property int $idpenerimaan
 * @property int $iddetail
 * @property double $nilaipagu
 * @property double $targetpagu
 * @property int $kodetarget
 * @property string $penerimaan
 */
class TargetPenerimaanRincian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'target_penerimaan_rincian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpenerimaan', 'iddetail', 'kodetarget'], 'integer'],
            [['nilaipagu', 'targetpagu'], 'number'],
            [['penerimaan'], 'string', 'max' => 50],
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
            'iddetail' => 'Iddetail',
            'nilaipagu' => 'Nilaipagu',
            'targetpagu' => 'Targetpagu',
            'kodetarget' => 'Kodetarget',
            'penerimaan' => 'Penerimaan',
        ];
    }
}
