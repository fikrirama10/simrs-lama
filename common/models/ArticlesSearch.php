<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Articles;

/**
 * ArticlesSearch represents the model behind the search form of `common\models\Articles`.
 */
class ArticlesSearch extends Articles
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'UserId', 'IdCat', 'IdBlock', 'IdPub', 'IsStatic', 'IsFeatured', 'IsHeadLine', 'ReadCount'], 'integer'],
            [['Title', 'SubTitle', 'Intro', 'Content', 'Created', 'Picture', 'Tags', 'SEO', 'LastUpdate'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Articles::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Id' => $this->Id,
            'Created' => $this->Created,
            'UserId' => $this->UserId,
            'IdCat' => $this->IdCat,
            'IdBlock' => $this->IdBlock,
            'IdPub' => $this->IdPub,
            'IsStatic' => $this->IsStatic,
            'IsFeatured' => $this->IsFeatured,
            'IsHeadLine' => $this->IsHeadLine,
            'ReadCount' => $this->ReadCount,
            'LastUpdate' => $this->LastUpdate,
        ]);

        $query->andFilterWhere(['like', 'Title', $this->Title])
            ->andFilterWhere(['like', 'SubTitle', $this->SubTitle])
            ->andFilterWhere(['like', 'Intro', $this->Intro])
            ->andFilterWhere(['like', 'Content', $this->Content])
            ->andFilterWhere(['like', 'Picture', $this->Picture])
            ->andFilterWhere(['like', 'Tags', $this->Tags])
            ->andFilterWhere(['like', 'SEO', $this->SEO]);

        return $dataProvider;
    }
}
