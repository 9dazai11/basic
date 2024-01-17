<?php

namespace app\controllers;

use app\models\Reception;
use app\models\ReceptionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Clients;
use Yii;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;

/**
 * ReceptionController implements the CRUD actions for Reception model.
 */
class ReceptionController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                    'denyCallback' => function ($rule, $action) {
                        return $action->controller->redirect('/site/login');
                    },
                ],
            ]
        );
    }

    /**
     * Lists all Reception models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ReceptionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination->pageSize = 5;

        // Если пользователь не является врачом, ограничиваем поиск его собственными записями
        if (!Yii::$app->user->identity->is_doctor) {
            $dataProvider->query->joinWith('client')->andWhere(['user_id' => Yii::$app->user->id]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reception model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Reception model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Reception();

        //Получение списка клиентов для текущего пользователя
        if (Yii::$app->user->identity->is_doctor) {
            $clientList = ArrayHelper::map(Clients::find()
                ->all(), 'id', 'FIO');
        } else {
            $clientList = ArrayHelper::map(Clients::find()
                ->where(['user_id' => Yii::$app->user->id])
                ->all(), 'id', 'FIO');
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // UPD: Проверка доступности выбранного времени. Если доступно - сохраяем, иначе выдаём ошибку.
                if ($this->isAvailable($model->admission_date, $model->doctor_id)) {
                    if ($model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Данное время уже занято, пожалуйста выберите другое.');
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'clientList' => $clientList,
        ]);
    }

    // UPD: Проверяет, доступно ли выбранное время у указанного врача.
    public function isAvailable($admissionDate, $doctorId)
    {
        return !Reception::find()
            ->where(['admission_date' => $admissionDate, 'doctor_id' => $doctorId])
            ->exists();
    }

    /**
     * Updates an existing Reception model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->user->identity->is_doctor) {
            $clientList = ArrayHelper::map(Clients::find()
                ->all(), 'id', 'FIO');
        } else {
            $clientList = ArrayHelper::map(Clients::find()
                ->where(['user_id' => Yii::$app->user->id])
                ->all(), 'id', 'FIO');
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'clientList' => $clientList,
        ]);
    }

    /**
     * Deletes an existing Reception model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Reception model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Reception the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reception::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
