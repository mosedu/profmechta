<?php

namespace app\modules\lectors\models;

use Yii;
use app\modules\lectors\Module;
use yii\db\ActiveRecord;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\base\Security;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%lector}}".
 *
 * @property integer $lec_id
 * @property string $lec_group
 * @property integer $lec_active
 * @property string $lec_email
 * @property string $lec_fam
 * @property string $lec_profession
 * @property string $lec_description
 * @property string $lec_pass
 * @property string $lec_created
 * @property string $lec_key
 */
class Lector extends \yii\db\ActiveRecord
{
    public $image; // картинка для вывода в списке лекторов

    public $imageDir = '';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['lec_created'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => [],
                ],
                'value' => (strtolower($this->db->driverName) == 'mysql') ? new Expression('NOW()') : 'NOW',
            ],
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'lec_key',
//                    ActiveRecord::EVENT_BEFORE_UPDATE => 'attribute2',
                ],
                'value' => function ($event) {
                           return (new Security())->generateRandomString(32);
                },
            ],
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'lec_pass',
//                    ActiveRecord::EVENT_BEFORE_UPDATE => 'attribute2',
                ],
                'value' => function ($event) {
                           return (new Security())->generateRandomString(6);
                },
            ],
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'lec_active',
                ],
                'value' => 0,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lector}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lec_description', 'lec_fam', 'lec_profession'], 'required'],
            [['lec_active'], 'integer'],
            [['lec_description'], 'string'],
            [['lec_created'], 'safe'],
            [['lec_group'], 'string', 'max' => 16],
            [['lec_email', 'lec_fam', 'lec_profession'], 'string', 'max' => 64],
            [['image'], 'file', 'maxSize' => 1000000, 'extensions' => ['jpg', 'png', 'tif', ], 'skipOnEmpty' => true, ],
//            [['image'], 'testImage', 'skipOnEmpty' => true, ],
            [['lec_pass', 'lec_key'], 'string', 'max' => 255],
        ];
    }

    /**
     *
     * Валидатор для файла: нужно посмотреть - квадратный ли он
     *
     * @param $attribute
     * @param $params
     */
    public function validateCountry($attribute, $params) {
        $oFile = UploadedFile::getInstance($this, $attribute);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lec_id' => Module::t('lector', 'LECTOR_ID'),
            'lec_group' => Module::t('lector', 'LECTOR_GROUP'),
            'lec_active' => Module::t('lector', 'LECTOR_ACTIVE'),
            'lec_email' => Module::t('lector', 'LECTOR_EMAIL'),
            'lec_fam' => Module::t('lector', 'LECTOR_FAM'),
            'lec_profession' => Module::t('lector', 'LECTOR_PROFESSION'),
            'lec_description' => Module::t('lector', 'LECTOR_DESCRIPTION'),
            'lec_pass' => Module::t('lector', 'LECTOR_PASSWORD'),
            'lec_created' => Module::t('lector', 'LECTOR_CREATED'),
            'lec_key' => Module::t('lector', 'LECTOR_API_KEY'),
            'image' => Module::t('lector', 'LECTOR_IMAGE_FILE'),
        ];
    }

    /**
     * @inheritdoc
     * @return LectorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LectorQuery(get_called_class());
    }

    /**
     * @return array
     */
    public static function getLectorProf() {
        $a = self::find()
            ->select('lec_profession')
            ->distinct()
            ->asArray()
            ->orderBy('lec_profession')
            ->all();
//        Yii::info('getLectorProf(): ' . print_r($a, true));
        return array_reduce($a, function($carry, $el){ $carry[] = $el['lec_profession']; return $carry; }, []);
//        return ArrayHelper::map($a, 'lec_profession', 'lec_profession');
    }

    /**
     *
     * @var string $sType
     *
     * @return callable
     */
    public function generateImageFileName($sType = '') {
        $oLector = $this;
        return function($origFileName) use ($oLector, $sType) {
            return $oLector->getOriginalImageFileName($sType, $origFileName);
        };
    }

    public function generateImageFileUrl($sType = '') {
        $sWebPath = Yii::getAlias('@app/web');
        return substr($this->getOriginalImageFileName($sType, ''), strlen($sWebPath));
    }

    /**
     *
     * @param string $sType
     * @param string $origFileName
     *
     */
    public function getOriginalImageFileName($sType, $origFileName) {
        $sf = Yii::getAlias('@app/web/img/lector/orig') . DIRECTORY_SEPARATOR . $this->lec_id . (empty($sType) ? '' : ('-' . $sType)) . '.jpg';
        return $sf;
    }

    public function getImage($sType = '') {
        $sf = $this->getOriginalImageFileName($sType, '');
        if( file_exists($sf) ) {
            return str_replace('\\', '/', substr($sf, strlen($_SERVER['DOCUMENT_ROOT'])));
        }
        return null;
    }

    /**
     * @param array $aParams
     * @return callable
     */
    public function createImageValidator($aParams = []) {
        return function($sImageFile) use ($aParams) {
            $aErrors = [];
            $a = getimagesize($sImageFile);
//            Yii::info('sImageFile = ' . $sImageFile);
//            Yii::info('aParams = ' . print_r($aParams, true));
//            Yii::info('a = ' . print_r($a, true));
            if( isset($aParams['minx']) && ($a[0] < $aParams['minx']) ) {
                $aErrors[] = 'Ширина картинки должна быть не меньше ' . $aParams['minx'] . 'px';
            }
            if( isset($aParams['maxx']) && ($a[0] > $aParams['maxx']) ) {
                $aErrors[] = 'Ширина картинки должна быть не больше ' . $aParams['maxx'] . 'px';
            }
            if( isset($aParams['miny']) && ($a[1] < $aParams['miny']) ) {
                $aErrors[] = 'Высота картинки должна быть не меньше ' . $aParams['miny'] . 'px';
            }
            if( isset($aParams['maxy']) && ($a[1] > $aParams['maxy']) ) {
                $aErrors[] = 'Высота картинки должна быть не больше ' . $aParams['maxy'] . 'px';
            }
            if( isset($aParams['x']) && ($a[0] != $aParams['x']) ) {
                $aErrors[] = 'Ширина картинки должна быть ' . $aParams['x'] . 'px';
            }
            if( isset($aParams['y']) && ($a[1] != $aParams['y']) ) {
                $aErrors[] = 'Высота картинки должна быть ' . $aParams['y'] . 'px';
            }
            if( isset($aParams['ratio']) && (abs($a[0] / $a[1] - $aParams['ratio']) > 0.01 ) ) {
                $aErrors[] = 'Отношение ширины к высоте у картинки должно быть ' . $aParams['ratio'] . ':1';
            }
            return $aErrors;
        };
    }

}
