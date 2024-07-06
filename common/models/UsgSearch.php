<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Usg;

/**
 * UsgSearch represents the model behind the search form of `common\models\Usg`.
 */
class UsgSearch extends Usg
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['idusg', 'no_rekmed', 'stpasien', 'nama', 'jenis_kelamin', 'usia', 'alamat', 'tglusg', 'jam', 'petugas'], 'safe'],
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
        $query = Usg::find()->orderBy(['tglusg'=>SORT_DESC]);

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
            'tglusg' => $this->tglusg,
            'jam' => $this->jam,
        ]);

        $query->andFilterWhere(['like', 'idusg', $this->idusg])
            ->andFilterWhere(['like', 'no_rekmed', $this->no_rekmed])
            ->andFilterWhere(['like', 'stpasien', $this->stpasien])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'jenis_kelamin', $this->jenis_kelamin])
            ->andFilterWhere(['like', 'usia', $this->usia])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'petugas', $this->petugas]);

        return $dataProvider;
    }
}
