<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DokumenKategori;

/**
 * DokumenKategoriSearch represents the model behind the search form about `common\models\DokumenKategori`.
 */
class DokumenKategoriSearch extends DokumenKategori
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id'], 'integer'],
            [['Kategori'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = DokumenKategori::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Id' => $this->Id,
        ]);

        $query->andFilterWhere(['like', 'Kategori', $this->Kategori]);

        return $dataProvider;
    }
}
