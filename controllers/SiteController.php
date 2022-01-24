<?php

namespace app\controllers;

use app\models\Posts;
use app\models\SignUp;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\Url;
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $posts = Posts::find();
        $countPosts = clone $posts;
        $pages = new Pagination(['totalCount' => $countPosts->count(), 'pageSize' => 6]);
        $models = $posts->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', ['posts' => $models, 'pages' => $pages]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionSingle()
    {
        $posts = Posts::find()->where(['id' => Yii::$app->request->get()['id']])->one();

        return $this->render('single', ['posts' => $posts]);
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
                return $this->goHome();
            }
        }

        return $this->render('login', [
            'login_model' => $login_model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
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
                return $this->goHome();
            }
        }
        return $this->render('register', ['model' => $model]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Posts;

        if (Yii::$app->request->isPost) {
            $post = new Posts;
            $post->title = Yii::$app->request->post()['Posts']['title'];
            $post->description = Yii::$app->request->post()['Posts']['description'];
            $post->created_at = date("Y-m-d H:i:s");
            $post->save();

            return $this->redirect(Url::to(['/site/index']));
        }
        return $this->render('create', ['model' => $model]);
    }
}
