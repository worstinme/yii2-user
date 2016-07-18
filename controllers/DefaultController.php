<?php
/**
 * @link https://github.com/worstinme/yii2-user
 * @copyright Copyright (c) 2014 Evgeny Zakirov
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace worstinme\user\controllers;

use Yii;
use worstinme\user\models\PasswordResetRequestForm;
use worstinme\user\models\ResetPasswordForm;
use worstinme\user\models\ConfirmEmailForm;
use worstinme\user\models\UserService;
use worstinme\user\models\UpdateForm;
use worstinme\user\models\SignupForm;
use worstinme\user\models\LoginForm;
use worstinme\user\models\User;

use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

class DefaultController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['logout','signup','update'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','update','request-email-confirm'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'request-email-confirm'=>['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    public function actionUpdate()
    {

        $model = UpdateForm::findOne(Yii::$app->user->identity->id);

        $confirm_email = $model->status == User::STATUS_WAIT || $model->status == User::STATUS_SOCIAL ? true : false;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('user','SUCCESS_UPDATE_FORM'));
        }

        return $this->render('update', [
            'model' => $model,
            'confirm_email'=>$confirm_email,
        ]);
    }

    public function actionLogin()
    {   

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                $model->login();
                Yii::$app->session->setFlash('success', 'Подтвердите ваш электронный адрес.');
                return $this->goHome();
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionConfirmEmail($token)
    {
        try {
            $model = new ConfirmEmailForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->confirmEmail()) {
            Yii::$app->session->setFlash('success', 'Спасибо! Ваш Email успешно подтверждён.');
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка подтверждения Email.');
        }

        return $this->goHome();
    }

    public function actionRequestPasswordReset()
    {

        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', Yii::t('user','REQUEST_PASWORD_RESET_SUCCESS'));
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', Yii::t('user','REQUEST_PASWORD_RESET_ERROR'));
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionRequestEmailConfirm()
    {
        $user = Yii::$app->user->identity;

        $user->generateEmailConfirmToken();

        if ($user->save()) {

            Yii::$app->session->setFlash('success', Yii::t('user','REQUEST_EMAIL_CONFIRM_SUCCESS'));

            Yii::$app->mailer->compose('@worstinme/user/mail/confirmEmail', ['user' => $user])
                ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name])
                ->setTo($user->email)
                ->setSubject('Подтверждение регистрации ' . Yii::$app->name)
                ->send();# code...
        }
        else {
            Yii::$app->session->setFlash('error', Yii::t('user','REQUEST_EMAIL_CONFIRM_ERROR'));
        }

        return $this->redirect(['update']);
    }

    public function actionResetPassword($token)
    {

        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Спасибо! Пароль успешно изменён.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }


    // auth clients

    public function onAuthSuccess($client)
    {
        $attributes = $client->getUserAttributes();

        $service  = $client->getId();

        if (empty($attributes['email']) && $service == 'vkontakte') {
            $attributes['email'] = $attributes['id'].'@vk.com';
        }
        elseif (empty($attributes['email']) && $service == 'twitter') {
            $attributes['email'] = $attributes['id'].'@twitter.com';
        }
        elseif (empty($attributes['email'])) {
            $attributes['email'] = $attributes['id']."@$service.com";
        }

        /* @var $auth Auth */
        $auth = UserService::find()->where([
            'source' => $client->getId(),
            'source_id' => $attributes['id'],
        ])->one();

        if (Yii::$app->user->isGuest) {

            if ($auth) { 

                // login
                $user = $auth->user;
                Yii::$app->user->login($user);

            } else { 

                // signup
                if (User::find()->where(['email' => $attributes['email']])->exists()) {

                    Yii::$app->session->setFlash('error', Yii::t('user', "SERVICE_USER_EMAIL_EXISTS"));

                } else {

                    $user = new User([
                        'username' => $attributes['email'],
                        'email' => $attributes['email'],
                        'status' => User::STATUS_SOCIAL
                    ]);

                    $user->setPassword(Yii::$app->security->generateRandomString(6));
                    $user->generateAuthKey();
                    $user->generatePasswordResetToken();

                    $transaction = $user->getDb()->beginTransaction();

                    if ($user->save()) {

                        $auth = new UserService([
                            'user_id' => $user->id,
                            'source' => $client->getId(),
                            'source_id' => (string)$attributes['id'],
                        ]);

                        if ($auth->save()) {
                            $transaction->commit();
                            Yii::$app->user->login($user);
                        }
                        else {
                            Yii::$app->session->setFlash('error', Yii::t('user', "SERVICE_REG_FAIL").' '.\yii\helpers\Json::encode($auth->getErrors()));
                        }
                    }
                    else {
                        Yii::$app->session->setFlash('error', Yii::t('user', "SERVICE_REG_FAIL").' '.\yii\helpers\Json::encode($user->getErrors()));
                    }
                }
            }

        } else { 

            // user already logged in
            if (!$auth) { 
                // add auth provider
                $auth = new UserService([
                    'user_id' => Yii::$app->user->identity->id,
                    'source' => $client->getId(),
                    'source_id' => $attributes['id'],
                ]);
                $auth->save();
            }
        }

        if (!Yii::$app->user->isGuest) {
            $this->action->successUrl = \yii\helpers\Url::previous();
        }
    }
}
