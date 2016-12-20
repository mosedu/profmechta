<?php

namespace app\modules\lessons\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use app\modules\lessons\models\Lesson;
use app\modules\lessons\models\Leslect;
use app\modules\lectors\models\Lector;
use yii\helpers\ArrayHelper;

/**
 * LeslectSearch represents the model behind the search form about `app\modules\lessons\models\Leslect`.
 */
class LeslectSearch extends Leslect
{
    public $lectorfio = null;
    public $lectorprof = null;
    public $year = null;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ll_id', 'll_lesson_id', 'll_lector_id'], 'integer'],
            [['lectorfio', 'year', ], 'integer'],
            [['lectorprof'], 'string', 'max' => 255, ],
            [['ll_reglink'], 'string', 'max' => 255, ],
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
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $attrLabels = parent::attributeLabels();
        $attrLabels['lectorfio'] = 'Лектор';
        $attrLabels['lectorprof'] = 'Профессия';
        $attrLabels['year'] = 'Год';
        return $attrLabels;
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
        $query->with(['lector']);

        // add conditions that should always apply here

        $aDataConf = [
            'query' => $query,
            'sort'=> [
                'defaultOrder' => isset($params['sort']) ? $params['sort'] : ['ll_date' => SORT_DESC, ]
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
            'll_id' => $this->ll_id,
            'll_lesson_id' => $this->ll_lesson_id,
            'll_lector_id' => $this->ll_lector_id,
            'll_date' => $this->ll_date,
        ]);

        return $dataProvider;
    }

    /**
     *
     * выдача ближайшей лекции
     * @var $nCou integer количество ближайщих
     * @return Leslect|array of Leslect
     *
     */
    public function findNearest($nCou = 1) {
        $isMysql = (strtolower($this->db->driverName) == 'mysql');
        $tName = self::tableName();
        $query = self::find()
            ->select($tName . '.*')
            ->leftJoin(Lesson::tableName() . ' lesson', '`lesson`.`les_id` = ' . $tName . '.`ll_lesson_id`')
            ->where([
                'and',
                ['>', self::tableName() . '.ll_date', $isMysql ? new Expression('NOW()') : 'NOW'],
                ['les_active' => Lesson::LESSON_STATUS_ACTIVE],
            ])
            ->orderBy(['ll_date' => SORT_ASC]);
        if( $nCou < 2 ) {
            $ob = $query->one();
        }
        else {
            $query->limit($nCou);
            $ob = $query->all();
        }
        return $ob;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchNext($params)
    {
        $isMysql = (strtolower($this->db->driverName) == 'mysql');
        $tName = self::tableName();

        $query = self::find()
//            ->select($tName . '.*')
            ->leftJoin(Lesson::tableName() . ' lesson', '`lesson`.`les_id` = ' . $tName . '.`ll_lesson_id`')
            ->where([
                'and',
                ['>', self::tableName() . '.ll_date', $isMysql ? new Expression('NOW()') : 'NOW'],
                ['les_active' => Lesson::LESSON_STATUS_ACTIVE],
            ]);
        $query->with(['lector', 'lesson']);

        // add conditions that should always apply here

        $aDataConf = [
            'query' => $query,
            'sort'=> [
                'defaultOrder' => isset($params['sort']) ? $params['sort'] : ['ll_date' => SORT_ASC, ]
            ]
        ];

        $aDataConf['pagination'] = [
            'pageSize' => isset($params['pagesize']) ? $params['pagesize'] : 8,
        ];

        $dataProvider = new ActiveDataProvider($aDataConf);

        $this->load($params);

        Yii::info('params = ' . print_r($params, true));
//        Yii::info('this = ' . print_r($this, true));

        if( !empty($this->lectorprof) ) {
            $query
                ->leftJoin(Lector::tableName() . ' lector', '`lector`.`lec_id` = ' . $tName . '.`ll_lector_id`')
                ->andFilterWhere(['like', 'lector.lec_profession', $this->lectorprof]);

        }

        if( !empty($this->year) ) {
            $query
                ->andFilterWhere(['=', 'YEAR(ll_date)', $this->year]);
        }

        if (!$this->validate()) {
            Yii::info('Error validate: ' . print_r($this->getErrors(), true));
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
//            'll_id' => $this->ll_id,
//            'll_lesson_id' => $this->ll_lesson_id,
            'll_lector_id' => $this->lectorfio,
//            'll_date' => $this->ll_date,
//            ['>', 'll_date', date('Y-m-d H:i:s')],
        ]);

        return $dataProvider;
    }

    /**
     * @return array
     */
    public static function getLessonYears() {
        // TODO:  объединить с лекцией и посмотреть на статус лекции
        $a = self::find()
            ->select('YEAR(ll_date) As year')
            ->distinct()
            ->asArray()
            ->all();
//        Yii::info('getLessonYears(): ' . print_r($a, true));
        return ArrayHelper::map($a, 'year', 'year');
    }
}
