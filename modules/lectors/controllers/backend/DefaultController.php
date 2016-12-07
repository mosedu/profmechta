<?php

namespace app\modules\lectors\controllers\backend;

use Yii;
use app\modules\lectors\models\Lector;
use app\modules\lectors\models\LectorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\web\Request;
use yii\web\Response;
use app\components\Imagefile;
use yii\web\UploadedFile;

/**
 * DefaultController implements the CRUD actions for Lector model.
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Lector models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LectorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lector model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Lector model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Lector();

        if( Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) ) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
//            return $this->redirect(['view', 'id' => $model->lec_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Lector model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if( Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) ) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $bRedirect = true;
            $oFunct = $model->createImageValidator(['maxx' => 500, 'maxy' => 500, 'ratio' => 1,]);
            Yii::info('$oFunct = ' . print_r($oFunct, true));
            $oFile = UploadedFile::getInstance($model, 'image');
            if( $oFile !== null ) {
                $oImage = new Imagefile(
                    $oFile->tempName,
                    $oFile->name,
                    $oFunct,
                    $model->generateImageFileName('base')
                );
                $bRedirect = $oImage->save();
                if( !$bRedirect ) {
                    $model->addErrors([
                        'image' => ($oImage->hasErrors() ? $oImage->getErrors() : ['Ошибка сохранения файла']),
                    ]);
                }
            }
            if( $bRedirect ) {
                return $this->redirect(['index', ]);
            }
//            return $this->redirect(['view', 'id' => $model->lec_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Lector model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionList()
    {
        $sQuery = trim(Yii::$app->request->post('term', ''));
        $nLimit = intval(Yii::$app->request->post('limit', 10));
        $nStart = intval(Yii::$app->request->post('start', 0));
        $a = explode(' ', $sQuery);
        if( count($a) > 1 ) {
            $sQuery = $a[0];
        }

        $aWhere = [
            'or',
            ['like', 'lec_fam', $sQuery],
            ['like', 'lec_profession', $sQuery],
        ];

        $oQuery = Lector::find()
            ->where($aWhere)
            ->orderBy(['lec_fam' => SORT_ASC, ]);
//            ->offset($nStart)
//            ->limit($nLimit);
        $nCount = $oQuery->count();

        $aData = ArrayHelper::map(
            $oQuery->all(),
            'lec_id',
            function($ob) {
                return [
                    'id' => $ob->lec_id,
                    'text' => $ob->lec_fam,
                    'profession' => $ob->lec_profession,
                    'description' => $ob->lec_description,
                ];
            }
        );

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ['results' => array_values($aData), 'total' => $nCount, ];
    }

    /**
     * Deletes an existing Lector model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Lector model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Lector the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lector::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
