<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "privilages".
 *
 * @property integer $idpriv
 * @property string $privilages
 *
 * @property User[] $users
 */
class Privilages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'privilages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['privilages'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idpriv' => 'Idpriv',
            'privilages' => 'Privilages',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['idpriv' => 'idpriv']);
    }
}
