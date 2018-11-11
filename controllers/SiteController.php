<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EquipmentStock;
use app\models\Orders;
use app\models\Organizer;

class SiteController extends Controller
{

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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionOborydovanie()
    {
        $query = EquipmentStock::find();
        $provider = new ActiveDataProvider([
          'query' => $query,
          'pagination' => [
            'pageSize' => 7,
          ],
          'sort' => [
            'defaultOrder'=>[]
          ],
        ]);

        $query = $query->all();

        return $this->render('oborydovanie', [
          'provider' => $provider,
          'query' => $query,
        ]);
    }

    public function actionOrders()
    {
        $query = orders::find();

        $provider = new ActiveDataProvider([
          'query' => $query,
          'pagination' => [
            'pageSize' => 7,
          ],
          'sort' => [
            'defaultOrder'=>[]
          ],
        ]);

        return $this->render('orders', [
          'provider' => $provider,
        ]);
    }

    public function actionOrganizer()
    {
        $query = Organizer::find();

        $provider = new ActiveDataProvider([
          'query' => $query,
          'pagination' => [
            'pageSize' => 7,
          ],
          'sort' => [
            'defaultOrder'=>[]
          ],
        ]);

        return $this->render('organizer', [
          'provider' => $provider,
        ]);
    }
}
