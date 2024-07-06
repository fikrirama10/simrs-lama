<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "statushub".
 *
 * @property integer $id
 * @property string $status_hub
 *
 * @property Pasisen[] $pasisens
 */
class Statushub extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'statushub';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_hub'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status_hub' => 'Status Hub',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPasisens()
    {
        return $this->hasMany(Pasisen::className(), ['id_status' => 'id']);
    }
}
