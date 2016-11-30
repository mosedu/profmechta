<?php

namespace app\modules\lessons\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\lessons\models\Leslect;

/**
 * LeslectSearch represents the model behind the search form about `app\modules\lessons\models\Leslect`.
 */
class LeslectSearch extends Leslect
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ll_id', 'll_lesson_id', 'll_lector_id'], 'integer'],
            [['ll_date'], 'safe'],
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
        $query = Leslect::find();

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
            'll_id' => $this->ll_id,
            'll_lesson_id' => $this->ll_lesson_id,
            'll_lector_id' => $this->ll_lector_id,
            'll_date' => $this->ll_date,
        ]);

        return $dataProvider;
    }
}
