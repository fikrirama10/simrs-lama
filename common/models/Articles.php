<?php

namespace common\models;

use Yii;


class Articles extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Content'], 'required'],
            [['Content'], 'string'],
            [['Created', 'LastUpdate','Picture'], 'safe'],
            [['UserId', 'IdCat', 'IdBlock', 'IdPub', 'IsStatic', 'IsFeatured', 'IsHeadLine', 'ReadCount'], 'integer'],
            [['Title', 'SubTitle','Tags', 'SEO'], 'string', 'max' => 255],
			[['Picture'], 'file', 'extensions'=>'jpg, gif, png','skipOnEmpty' => true],
            [['Intro'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'SubTitle' => 'Sub Title',
            'Intro' => 'Intro',
            'Content' => 'Content',
            'Created' => 'Created',
            'UserId' => 'User ID',
            'IdCat' => 'Id Cat',
            'IdBlock' => 'Id Block',
            'IdPub' => 'Id Pub',
            'IsStatic' => 'Is Static',
            'IsFeatured' => 'Is Featured',
            'Picture' => 'Picture',
            'IsHeadLine' => 'Is Head Line',
            'Tags' => 'Tags',
            'SEO' => 'Seo',
            'ReadCount' => 'Read Count',
            'LastUpdate' => 'Last Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
   	
	public function getCategory()
    {
        return $this->hasOne(Articlescategory::className(), ['IdCat' => 'IdCat']);
    }

    	
	public function getPublicity()
    {
        return $this->hasOne(ArticlesPublish::className(), ['IdPub' => 'IdPub']);
    }
	
	public function getPpid()
    {
        return $this->hasOne(Ppid::className(), ['Kode' => 'PPID']);
    }
	
	public function getLatest($limit)
	{
		return $this->find()->where(['IdPub' => 2])->orderBy(['Id' => SORT_DESC])->limit($limit)->all();
	}
	
	public function getLatestRelease($limit)
	{
		return $this->find()->where(['IdPub' => 2, 'IdCat' => 6])->orderBy(['Id' => SORT_DESC])->limit($limit)->all();
	}
		
	public function getLatestNews($limit)
	{
		
		$rows = (new \yii\db\Query())
			  ->select('IdCat')
		      ->from('articles_category')
			  ->where(['Parent_IdCat' => 3])
			  ->all();
		
		return $this->find()->where(['IdPub' => 2,'IdCat' => $rows])->orderby(['Id' => SORT_DESC])->limit($limit)->all();
	}
	
	public function readPicture($id)
	{
		//$max = $this::find()->select('Picture')->scalar(); 
		$pic = $this::find()
		->where(['Id' => $id])
		->one();
		return $this->Picture;

	}
	
	
}/* end of class */
