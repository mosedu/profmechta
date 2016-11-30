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
            [['ll_lesson_id', 'll_lector_id'], 'required'],
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
        ];
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
