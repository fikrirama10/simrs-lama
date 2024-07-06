<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "articles_category".
 *
 * @property int $IdCat
 * @property string $Category
 * @property int $Parent_IdCat
 * @property string $Component
 */
class Articlescategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Parent_IdCat'], 'integer'],
            [['Component'], 'required'],
            [['Category'], 'string', 'max' => 40],
            [['Component'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdCat' => 'Id Cat',
            'Category' => 'Category',
            'Parent_IdCat' => 'Parent  Id Cat',
            'Component' => 'Component',
        ];
    }
}
