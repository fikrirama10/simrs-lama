<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DokumenDownload;

/**
 * DokumenDownloadSearch represents the model behind the search form about `common\models\DokumenDownload`.
 */
class DokumenDownloadSearch extends DokumenDownload
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'UserId'], 'integer'],
            [['Kode', 'Waktu', 'IP'], 'safe'],
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
        $query = DokumenDownload::find()->orderby(['Waktu' => SORT_DESC]);

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
            'Waktu' => $this->Waktu,
            'UserId' => $this->UserId,
        ]);

        $query->andFilterWhere(['like', 'Kode', $this->Kode])
            ->andFilterWhere(['like', 'IP', $this->IP]);

        return $dataProvider;
    }
}
