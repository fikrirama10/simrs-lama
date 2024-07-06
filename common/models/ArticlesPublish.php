<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "articles_publish".
 *
 * @property int $IdPub
 * @property string $Publicity
 */
class ArticlesPublish extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles_publish';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Publicity'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdPub' => 'Id Pub',
            'Publicity' => 'Publicity',
        ];
    }
}
