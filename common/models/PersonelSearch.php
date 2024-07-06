<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Personel;

/**
 * PersonelSearch represents the model behind the search form of `common\models\Personel`.
 */
class PersonelSearch extends Personel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nik', 'nrp'], 'integer'],
            [['foto', 'pangkat', 'nama', 'tgllahir', 'nohp', 'kepegawaian', 'profesi', 'alamat'], 'safe'],
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
        $query = Personel::find();

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
            'nik' => $this->nik,
            'nrp' => $this->nrp,
            'tgllahir' => $this->tgllahir,
        ]);

        $query->andFilterWhere(['like', 'foto', $this->foto])
            ->andFilterWhere(['like', 'pangkat', $this->pangkat])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'nohp', $this->nohp])
            ->andFilterWhere(['like', 'kepegawaian', $this->kepegawaian])
            ->andFilterWhere(['like', 'profesi', $this->profesi])
            ->andFilterWhere(['like', 'alamat', $this->alamat]);

        return $dataProvider;
    }
}
