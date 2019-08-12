<?php

namespace app\controllers;

use app\models\Action;
use app\models\BlockRule;
use app\models\Condition;
use app\models\Event;
use Yii;
use app\models\Rule;
use app\models\search\RuleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RuleController implements the CRUD actions for Rule model.
 */
class RuleController extends Controller
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
     * Lists all Rule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RuleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rule model.
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
     * Creates a new Rule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rule();
        $blockRuleModel = new BlockRule();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $blockRuleModel->load(Yii::$app->request->post());
            $blockRuleModel->rule = $model->id;
            $blockRuleModel->save();

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'blockRuleModel' => $blockRuleModel,
        ]);
    }

    /**
     * Updates an existing Rule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $blockRuleModel = empty($model->blockRules) ? new BlockRule() : $model->getBlockRules()->one();
        $blockRuleModel->rule = $model->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $blockRuleModel->load(Yii::$app->request->post());
            $blockRuleModel->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'blockRuleModel' => $blockRuleModel,
        ]);
    }

    /**
     * Deletes an existing Rule model.
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

    public function actionModal()
    {
        $className = Yii::$app->request->post('className');
        $modal_id = Yii::$app->request->post('id');
        $action = Yii::$app->request->post('action');

        if (!empty($className)) {
            if ($className == Event::DATA_TYPE) {
                $model = (empty($modal_id)) ? new Event() : Event::findOne(['id' => $modal_id]);

                if ($action == 'view' && !$model->isNewRecord) {
                    return json_encode([
                        'title' => $model->name,
                        'body' => $this->renderPartial('@app/views/event/_table', [
                            'model' => $model,
                        ])
                    ]);
                } else {
                    return $this->renderPartial('_event', [
                        'model' => $model,
                    ]);
                }
            }
            if ($className == Condition::DATA_TYPE) {
                $model = (empty($modal_id)) ? new Condition() : Condition::findOne(['id' => $modal_id]);

                return $this->renderPartial('_condition', [
                    'model' => $model,
                ]);
            }
            if ($className == Action::DATA_TYPE) {
                $model = (empty($modal_id)) ? new Action() : Action::findOne(['id' => $modal_id]);

                return $this->renderPartial('_action', [
                    'model' => $model,
                ]);
            }
        }
        return "<div>Ошибка</div>";
    }

    /**
     * Finds the Rule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
