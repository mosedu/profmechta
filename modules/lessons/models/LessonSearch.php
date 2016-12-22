<?php

namespace app\modules\lessons\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\lessons\models\Lesson;

/**
 * LessonSearch represents the model behind the search form about `app\modules\lessons\models\Lesson`.
 */
class LessonSearch extends Lesson
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['les_id', 'les_active'], 'integer'],
            [['les_title', 'les_description', 'les_created'], 'safe'],
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
        $query = Lesson::find();
        $query->with('nearest');

        // add conditions that should always apply here

//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//        ]);

        $aDataConf = [
            'query' => $query,
            'sort'=> [
                'defaultOrder' => isset($params['sort']) ? $params['sort'] : ['les_created' => SORT_DESC, ]
            ]
        ];

        $aDataConf['pagination'] = [
            'pageSize' => isset($params['pagesize']) ? $params['pagesize'] : 10,
        ];

        $dataProvider = new ActiveDataProvider($aDataConf);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'les_id' => $this->les_id,
            'les_active' => $this->les_active, // ($this->les_active == '') ? self::LESSON_STATUS_ACTIVE : $this->les_active,
            'les_created' => $this->les_created,
        ]);

        $query->andFilterWhere(['like', 'les_title', $this->les_title])
            ->andFilterWhere(['like', 'les_description', $this->les_description]);

        return $dataProvider;
    }

}
