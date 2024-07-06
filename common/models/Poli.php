<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "poli".
 *
 * @property integer $id

 * @property string $namapoli
 */
class Poli extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'poli';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'namapoli','poll'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'namapoli' => 'Namapoli',
        ];
    }
}
