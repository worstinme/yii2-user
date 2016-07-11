<?php

namespace worstinme\user\models;

use Yii;


class UpdateForm extends User
{
    public $password;
    public $password_repeat;

    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => Yii::t('user', 'ERROR_USERNAME_EXISTS'), 
                'when' => function($model) { return $model->username != $model->getOldAttribute('username'); } ],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['password', 'string', 'min' => 6],
            ['password_repeat', 'required','when'=>function($model){ return !empty($model->password);},'whenClient'=> "function (attribute, value) {
                return $('#updateform-password').val();
            }"],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>Yii::t('user','ERROR_PASSWORD_MATCH')],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => Yii::t('user', 'ERROR_EMAIL_EXISTS'), 
                'when' => function($model) { return $model->email != $model->getOldAttribute('email'); } ],

        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['username', 'email', 'password','password_repeat'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('user', 'USER_USERNAME'),
            'email' => Yii::t('user', 'USER_EMAIL'),
            'password' => Yii::t('user', 'USER_PASSWORD'),
            'password_repeat' => Yii::t('user', 'USER_PASSWORD_REPEAT'),
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if (!empty($this->password)) {
                $this->setPassword($this->password);
            }

            return true;
        }
        return false;
    }

}