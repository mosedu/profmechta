<?php

namespace app\modules\lectors\controllers\frontend;

use Yii;
use app\modules\lectors\models\Lector;
use app\modules\lectors\models\LectorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

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

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Lector models.
     * @return mixed
     */
    public function actionList()
    {
        $oQuery = Lector::find()
            ->select('lec_id As id, lec_fam As text, lec_fam, lec_profession');

        $sTerm = trim(Yii::$app->request->getQueryParam('term', ''));
        if( !empty($sTerm) ) {
            $oQuery->where([
                'like', 'lec_fam', $sTerm
            ]);
        }
        $total_count = $oQuery->count();
        $nPage = 1;
        $nPageSize = 15;

        $oQuery
            ->limit($nPageSize);

        if( $nPage > 1 ) {
            $oQuery
                ->offset(($nPage - 1) * $nPageSize);
        }

        $items = $oQuery
            ->asArray()
            ->all();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'items' => $items,
            'total_count' => intval($total_count),
//            'incomplete_results' => false,
        ];
    }

    /**
     * Lists all Lector models.
     * @return mixed
     */
    public function actionProflist()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'results' => Lector::find()
                ->select('lec_profession As id, lec_profession As text')
                ->distinct()
                ->asArray()
                ->all(),
        ];
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
