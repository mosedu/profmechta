<?php

namespace app\modules\lessons\models;

use Yii;
use app\modules\lectors\models\Lector;
use app\modules\lessons\models\Lesson;

/**
 * This is the model class for table "{{%leslect}}".
 *
 * @property integer $ll_id
 * @property integer $ll_lesson_id
 * @property integer $ll_lector_id
 * @property string $ll_date
 * @property string $ll_reglink
 */
class Leslect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%leslect}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                ['ll_date'],
                'filter',
                'filter' => function ($value) {
                    $value = trim($value);
                    if( preg_match('|([\\d]{1,2})\\.([\\d]{1,2})\\.([\\d]{4})\\s*([\\d]{1,2}):([\\d]{1,2})|', $value, $a) ) {
                        $t = mktime(
                            intval($a[4]),
                            intval($a[5]),
                            0,
                            intval($a[2]),
                            intval($a[1]),
                            intval($a[3])
                        );
                        $value = date('Y-m-d H:i:s', $t);
                    }
                    return $value;
                }
            ],
            [['ll_lesson_id', 'll_lector_id'], 'required'],
            [['ll_reglink'], 'string'],
            [['ll_reglink'], 'url'],
            [['ll_lesson_id', 'll_lector_id'], 'integer'],
            [['ll_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'll_id' => 'ID',
            'll_lesson_id' => 'Лекция', // Yii::t('lesson', 'Лекция'),
            'll_lector_id' => 'Лектор', // Yii::t('lesson', 'Лектор'),
            'll_date' => 'Дата', // Yii::t('lesson', 'Дата'),
            'll_reglink' => 'Ссылка на регистрацию', // Yii::t('lesson', 'Дата'),
        ];
    }

    /**
     * Очищаем запись вместо удаления
     */
    public function clear() {
        $this->ll_lesson_id = null;
        $this->ll_lector_id = null;
        $this->ll_date = null;
        $bRet = $this->save(false);
        Yii::info('clear('.$this->ll_id.') = ' . ($bRet ? 'true' : 'false') . ' errors = ' . print_r($this->getErrors(), true));
        return $bRet;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLector() {
        return $this->hasOne(
            Lector::className(),
            [
                'lec_id' => 'll_lector_id',
            ]
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLesson() {
        return $this->hasOne(
            Lesson::className(),
            [
                'les_id' => 'll_lesson_id',
            ]
        );
    }

    /**
     * @param array $aFilter
     */
    public static function clearDates($aFilter = []) {
        Yii::info('clearDates() aFilter = ' . print_r($aFilter, true));
        self::updateAll(
            [
                'll_lesson_id' => 0,
                'll_lector_id' => 0,
                'll_date' => null,
            ],
            $aFilter
        );
    }

    /**
     * @param array $aData
     * @return int
     * @throws \yii\db\Exception
     */
    public static function addDate($aData = []) {
        $db = Yii::$app->db;
        $aSet = [];
        $aParams = [];
        foreach($aData As $k=>$v) {
            $sParam = ':' . $k;
            $aSet[] = $k . ' = ' . $sParam;
            $aParams[$sParam] = $v;
        }

        $sSql = 'Update ' . self::tableName() . ' Set ' . implode(', ', $aSet) . ' Where ll_date Is NULL Limit 1';

        if( $db->driverName != 'mysql' ) {
            $oEmpty = self::findOne('ll_date Is NULL');
            $nId = -1;
            if( $oEmpty !== null ) {
                $nId = $oEmpty->ll_id;
            }
            $sSql = 'Update ' . self::tableName() . ' Set ' . implode(', ', $aSet) . ' Where ll_date Is NULL And ll_id = ' . $nId;
        }

        $nUpdated = $db->createCommand($sSql, $aParams)->execute();
        if( $nUpdated == 0 ) {
            // TODO: может через ActiveRecord?
            $sSql = 'Insert Into ' . self::tableName() . ' ('.implode(',', array_keys($aData)).') Values ('.implode(',', array_keys($aParams)).')';
            $nUpdated = $db->createCommand($sSql, $aParams)->execute();
        }
        return $nUpdated;
    }
}
