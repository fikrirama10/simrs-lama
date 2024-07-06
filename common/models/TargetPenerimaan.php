<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "target_penerimaan".
 *
 * @property int $id
 * @property string $kodetarget
 * @property int $iduser
 * @property string $tahun
 * @property string $bulan
 * @property string $created
 */
class TargetPenerimaan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'target_penerimaan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iduser'], 'integer'],
            [['nilaipagu'], 'number'],
            [['tahun', 'bulan', 'created'], 'safe'],
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
            'kodetarget' => 'Kodetarget',
            'iduser' => 'Iduser',
            'tahun' => 'Tahun',
            'bulan' => 'Bulan',
            'created' => 'Created',
        ];
    }
	
}
