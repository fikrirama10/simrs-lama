<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jenispekerjaan".
 *
 * @property integer $id
 * @property string $jenis
 */
class Jenispekerjaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jenispekerjaan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenis'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenis' => 'Jenis',
        ];
    }
}
