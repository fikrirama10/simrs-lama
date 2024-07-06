<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dokumen_availability".
 *
 * @property integer $IdAv
 * @property string $Availability
 */
class DokumenAvailability extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dokumen_availability';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Availability'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdAv' => 'Id Av',
            'Availability' => 'Availability',
        ];
    }
}
