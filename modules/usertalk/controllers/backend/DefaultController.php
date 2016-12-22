<?php

namespace app\modules\usertalk\controllers\backend;

use Yii;
use app\modules\usertalk\models\Usertalk;
use app\modules\usertalk\models\UsertalkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\web\Response;

/**
 * DefaultController implements the CRUD actions for Usertalk model.
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
//        ];
//    }

    /**
     * Lists all Usertalk models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsertalkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usertalk model.
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
     * Creates a new Usertalk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usertalk();

        if( Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $aError = ActiveForm::validate($model);
            if( count($aError) == 0 ) {
                $model->save();
            }
            else {
                Yii::info('Validate error: ' . print_r($aError, true));
            }
            return $aError;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->refresh();
//            return $this->redirect(['view', 'id' => $model->usertalk_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Usertalk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', ]);
//            return $this->redirect(['view', 'id' => $model->usertalk_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Usertalk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->usertalk_status = Usertalk::USER_TALK_STATUS_DELETED;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionSetflag($id)
    {
        $model = $this->findModel($id);
        $aFlags = Usertalk::getAllStatuses();
        $nStatus = Yii::$app->request->getQueryParam('flag', Usertalk::USER_TALK_STATUS_ACTIVE);
        $model->usertalk_status = isset($aFlags[$nStatus]) ? $nStatus : Usertalk::USER_TALK_STATUS_ACTIVE;
        $model->save();

        return $this->renderContent($model->getStatus());

        return $this->redirect(['index']);
    }

    /**
     * Finds the Usertalk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usertalk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usertalk::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
