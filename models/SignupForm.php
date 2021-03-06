<?php

namespace worstinme\user\models;

use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $verifyCode;
    public $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => Yii::t('user', 'ERROR_USERNAME_EXISTS')],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => Yii::t('user', 'ERROR_EMAIL_EXISTS')],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['verifyCode', 'captcha', 'captchaAction' => '/user/default/captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('user', 'USER_USERNAME'),
            'email' => Yii::t('user', 'USER_EMAIL'),
            'password' => Yii::t('user', 'USER_PASSWORD'),
            'verifyCode' => Yii::t('user', 'USER_VERIFY_CODE'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {

            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->status = User::STATUS_ACTIVE;
            $user->generateAuthKey();
            $user->generateEmailConfirmToken();

            if ($user->save()) {
                Yii::$app->mailer->compose('@worstinme/user/mail/confirmEmail', ['user' => $user])
                    ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name])
                    ->setTo($this->email)
                    ->setSubject('Подтверждение регистрации ' . Yii::$app->name)
                    ->send();
            }

            return $user;
        }

        return null;
    }

    public function login()
    {
        if (($user = User::findByUsername($this->username)) !== null) {
            return Yii::$app->user->login($user, 0);
        }
    }

}