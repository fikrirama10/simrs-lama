<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rxlabor".
 *
 * @property integer $id
 * @property string $idrawat
 * @property string $rx_labor
 */
class Rxlabor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rxlabor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rx_labor'], 'string'],
            [['idrawat'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idrawat' => 'Idrawat',
            'rx_labor' => 'Rx Labor',
        ];
    }
}
