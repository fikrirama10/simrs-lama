<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Radmcu;

/**
 * RadmcuSearch represents the model behind the search form of `common\models\Radmcu`.
 */
class RadmcuSearch extends Radmcu
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idrad', 'usia'], 'integer'],
            [['tanggal', 'rmmcu', 'nama', 'alamat', 'dokter', 'kesan', 'klinis', 'hasil', 'nofoto'], 'safe'],
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
        $query = Radmcu::find()->orderby(['tanggal'=>SORT_DESC]);

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
            'idrad' => $this->idrad,
            'tanggal' => $this->tanggal,
            'usia' => $this->usia,
        ]);

        $query->andFilterWhere(['like', 'rmmcu', $this->rmmcu])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'dokter', $this->dokter])
            ->andFilterWhere(['like', 'kesan', $this->kesan])
            ->andFilterWhere(['like', 'klinis', $this->klinis])
            ->andFilterWhere(['like', 'hasil', $this->hasil])
            ->andFilterWhere(['like', 'nofoto', $this->nofoto]);

        return $dataProvider;
    }
}
