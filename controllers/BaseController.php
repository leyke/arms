<?php

namespace app\controllers;

use app\models\Base;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ActionController implements the CRUD actions for Action model.
 */
class BaseController extends Controller
{

    /**
     * @param $action
     * @return bool|\yii\web\Response
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest && $action->id != 'login') {
            return $this->redirect(['site/login']);
        }

        return parent::beforeAction($action);
    }

}
