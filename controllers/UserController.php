<?php

namespace app\controllers;

use app\models\Application;
use app\models\Role;
use app\models\UserRole;
use Yii;
use app\models\User;
use app\models\search\UserSearch;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends BaseController
{
    /**
     * {@inheritdoc}
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if (!empty($model->rolesBuf)) {
                foreach ($model->rolesBuf as $link) {
                    $linkNew = new UserRole();
                    $linkNew->load($link, UserRole::className());
                    $linkNew->description = $link['description'];

                    $linkNew->user_e = $model->id;
                    $linkNew->save(true, ['application', 'user_e', 'role', 'updu', 'ver', 'updt', 'description']);

                }
            }

            return $this->redirect(['index']);
        }

        $applications = ArrayHelper::map(Application::find()->all(), 'id', 'name');
        $roles = ArrayHelper::map(Role::find()->all(), 'id', 'name');

        return $this->render('create', [
            'model' => $model,
            'applications' => $applications,
            'roles' => $roles
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if (!empty($model->rolesBuf)) {
                foreach ($model->rolesBuf as $link) {
                    $linkNew = UserRole::findOne(['id' => $link['id']]);
                    if (empty($linkNew)) {
                        $linkNew = new UserRole($link);
                        $linkNew->user_e = $model->id;
                    }
                    $linkNew->load($link, UserRole::className());
                    $linkNew->description = $link['description'];
                    $linkNew->save(true, ['application', 'user_e', 'role', 'updu', 'ver', 'updt', 'description']);
                }
            } else {
                UserRole::deleteAll(['id' => $model->id]);
            }

            return $this->redirect(['index']);
        }

        $applications = ArrayHelper::map(Application::find()->all(), 'id', 'name');
        $roles = ArrayHelper::map(Role::find()->all(), 'id', 'name');

        $model->rolesBuf = $model->userRoles;

        return $this->render('update', [
            'model' => $model,
            'applications' => $applications,
            'roles' => $roles
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteParam()
    {
        $id = Yii::$app->request->post('param_id');

        $model = UserRole::findOne(['id' => $id]);

        if (!empty($model)) {
            $model->delete();
            return true;
        }

        throw new NotFoundHttpException('Связь не найдена');

    }
}
