<?php

namespace app\controllers;

use app\models\Discipline;
use app\models\FilterTeachers;
use app\models\TeacherProfile;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
     * {@inheritdoc}
     */
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $filterTeachersModel = new FilterTeachers();
        $isFilter = false;

        if ($filterTeachersModel->load(Yii::$app->request->post())) {
            Yii::debug(array2str($filterTeachersModel), "TEST");
            $isFilter = true;
        }

        $query = TeacherProfile::find();

        if ($isFilter) {
            $prices = explode('-', $filterTeachersModel['price']);

            $teacherProfiles = $query
                ->where(
                    ['and', 'id_discipline=:id_discipline', ['between', 'price', $prices[0], $prices[1]]],
                    ['id_discipline' => $filterTeachersModel['discipline']])
                ->all();
        } else {
            $teacherProfiles = $query
                ->all();
        }

        $disciplines = Discipline::find()->all();



        return $this->render('index', [
            'teacherProfiles' => $teacherProfiles,
            'disciplines' => $disciplines,
            'filterTeachersModel' => $filterTeachersModel
        ]);
    }

    public function actionTeacher($id = NULL) {
        if ($id === NULL)
            throw new HttpException(404, "Not found!");

        $teacherProfile = TeacherProfile::findOne($id);

        if ($teacherProfile === NULL)
            throw new HttpException(404, 'Document Does Not Exist');

        return $this->render('teacher', [
            'teacherProfile' => $teacherProfile
        ]);
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
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

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
