<?php

namespace app\controllers;

use app\models\Posts;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class PostController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create'],
                'rules' => [
                    [
                        'actions' => ['create'],
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
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Posts;
        $fromData = Yii::$app->request->post();

        if (Yii::$app->request->isPost && $model->load($fromData) && $model->validate()) {
            $post = new Posts;
            $post->title = Yii::$app->request->post()['Posts']['title'];
            $post->description = Yii::$app->request->post()['Posts']['description'];
            $post->nickname = Yii::$app->user->identity->name;
            $post->created_at = date("Y-m-d H:i:s");
            $post->save();

            return $this->redirect(Url::to(['/post/index']));
        }
        return $this->render('create', ['model' => $model]);
    }


}
