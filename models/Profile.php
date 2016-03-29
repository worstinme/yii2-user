<?php

namespace worstinme\user\models;

use yii\db\ActiveRecord;
use yii\helpers\Json;
use Yii;


class Profile extends ActiveRecord
{
    public $params;
    public $jsonParams = [];
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => Yii::t('user', 'ERROR_USERNAME_EXISTS'), 
                'when' => function($model) { return $model->username != $model->getOldAttribute('username'); } ],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => Yii::t('user', 'ERROR_EMAIL_EXISTS'), 
                'when' => function($model) { return $model->username != $model->getOldAttribute('username'); } ],

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
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }

    public function __get($name)
    { 
        if (in_array($name, $this->jsonParams)) {
            return $this->getJsonParams($name);
        } else {
            return parent::__get($name);
        }
    }

    public function __set($name, $value)
    { 
        if (in_array($name, $this->jsonParams)) {
            return $this->setJsonParams($name, $value);
        } else {
            return parent::__set($name, $value);
        }
    } 

    public function getJsonParams($name) {
        $params = !empty($this->params) ? Json::decode($this->params) : [];
        return isset($params['metaKeywords']) ? $params['metaKeywords'] : '';
    }

    public function setJsonParams($name,$value) {
        $params = !empty($this->params) ? Json::decode($this->params) : [];
        $params[$name] = $value;
        return $this->params = Json::encode($params);
    }

}