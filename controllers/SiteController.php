<?php

namespace app\controllers;

use app\models\SignUp;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $login_model = new LoginForm();
        if (Yii::$app->request->isPost) {
            $login_model->attributes = Yii::$app->request->post('LoginForm');
            if ($login_model->validate()) {
                Yii::$app->user->login($login_model->getUser());
                return $this->redirect(['/post/index']);
            }
        }

        return $this->render('login', [
            'login_model' => $login_model,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionRegister()
    {
        $model = new SignUp();

        if (Yii::$app->request->isPost) {
            $model->attributes = Yii::$app->request->post('SignUp');

            if ($model->validate()) {
                $model->signup();
                $identity = User::find()->where(['email' => Yii::$app->request->post()['SignUp']['email']])->one();
                Yii::$app->user->login($identity);
                return $this->redirect(['/post/index']);
            }
        }
        return $this->render('register', ['model' => $model]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['/post/index']);
    }
}
