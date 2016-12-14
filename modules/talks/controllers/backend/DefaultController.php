<?php

namespace app\modules\talks\controllers\backend;

use Yii;
use app\modules\talks\models\Reply;
use app\modules\talks\models\ReplySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\web\UploadedFile;
use app\components\Imagefile;

/**
 * DefaultController implements the CRUD actions for Reply model.
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
     * Lists all Reply models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReplySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reply model.
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
     * Creates a new Reply model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        return $this->actionUpdate(0);
//        $model = new Reply();
//
//        if( Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
//            Yii::$app->response->format = Response::FORMAT_JSON;
//            return ActiveForm::validate($model);
//        }
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['index', ]);
////            return $this->redirect(['view', 'id' => $model->reply_id]);
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);
    }

    /**
     * Updates an existing Reply model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if( $id == 0 ) {
            $model = new Reply();
        }
        else {
            $model = $this->findModel($id);
        }

        if( Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $bRedirect = true;
            $oFunct = $model->createImageValidator(['maxx' => 500, 'maxy' => 500, 'ratio' => 1,]);
//            Yii::info('$oFunct = ' . print_r($oFunct, true));
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
//            return $this->redirect(['view', 'id' => $model->reply_id]);
        }

        return $this->render(( $id == 0 ) ? 'create' : 'update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Reply model.
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
     * Finds the Reply model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reply the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reply::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
