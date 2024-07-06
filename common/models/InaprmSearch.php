<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Inaprm;

/**
 * InaprmSearch represents the model behind the search form of `common\models\Inaprm`.
 */
class InaprmSearch extends Inaprm
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pengembalian', 'kelengkapan', 'validator'], 'integer'],
            [['no_rekmed', 'tglpulang', 'tglskembali'], 'safe'],
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
        $query = Inaprm::find();

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
            'id' => $this->id,
            'tglpulang' => $this->tglpulang,
            'tglskembali' => $this->tglskembali,
            'pengembalian' => $this->pengembalian,
            'kelengkapan' => $this->kelengkapan,
            'validator' => $this->validator,
        ]);

        $query->andFilterWhere(['like', 'no_rekmed', $this->no_rekmed]);

        return $dataProvider;
    }
}
