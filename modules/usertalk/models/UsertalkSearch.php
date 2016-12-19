<?php

namespace app\modules\usertalk\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\usertalk\models\Usertalk;

/**
 * UsertalkSearch represents the model behind the search form about `app\modules\usertalk\models\Usertalk`.
 */
class UsertalkSearch extends Usertalk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usertalk_id', 'usertalk_status', 'usertalk_created_ip'], 'integer'],
            [['usertalk_fio', 'usertalk_email', 'usertalk_text', 'usertalk_created'], 'safe'],
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
        $query = Usertalk::find();

        // add conditions that should always apply here

//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//        ]);

        $aDataConf = [
            'query' => $query,
            'sort'=> [
                'defaultOrder' => isset($params['sort']) ? $params['sort'] : ['usertalk_created' => SORT_DESC, ]
            ]
        ];

        if( isset($params['pagesize']) ) {
            $aDataConf['pagination'] = [
                'pageSize' => $params['pagesize'],
            ];
        }

        $dataProvider = new ActiveDataProvider($aDataConf);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'usertalk_id' => $this->usertalk_id,
            'usertalk_status' => empty($this->usertalk_status) ? [self::USER_TALK_STATUS_ACTIVE, self::USER_TALK_STATUS_VISIBLE,] : $this->usertalk_status,
            'usertalk_created_ip' => $this->usertalk_created_ip,
            'usertalk_created' => $this->usertalk_created,
        ]);

        $query->andFilterWhere(['like', 'usertalk_fio', $this->usertalk_fio])
            ->andFilterWhere(['like', 'usertalk_email', $this->usertalk_email])
            ->andFilterWhere(['like', 'usertalk_text', $this->usertalk_text]);

        return $dataProvider;
    }

    /**
     * @param int $nCount
     * @return array
     */
    public function getRundomMessages($nCount = 3) {
        $aResult = [];
        $aId = Usertalk::find()
            ->select('usertalk_id')
            ->andFilterWhere([
                'usertalk_status' => self::USER_TALK_STATUS_VISIBLE,
            ])
            ->orderBy(['usertalk_created' => SORT_DESC])
            ->limit(150)
            ->column();
        $i = mt_rand(4, 9);
        while($i-- > 0) {
            shuffle($aId);
        }
        if( count($aId) > $nCount ) {
            $aId = array_splice($aId, 0, $nCount);
        }
        if( count($aId) > 0 ) {
            $aResult = Usertalk::findAll(['usertalk_id' => $aId]);
        }
        return $aResult;
    }
}
