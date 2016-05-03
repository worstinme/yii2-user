<?php

use yii\db\Migration;
use yii\base\InvalidConfigException;
use yii\rbac\DbManager;

class m160503_134857_default_user extends Migration
{

    protected function getAuthManager()
    {
        $authManager = Yii::$app->getAuthManager();
        if (!$authManager instanceof DbManager) {
            throw new InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
        }
        return $authManager;
    }

    public function safeUp()
    {

        $authManager = $this->getAuthManager();

        $this->insert('{{%user}}', [
            'created_at' => time(),
            'updated_at' =>  time(),
            'username'=>'administrator',
            'password_hash'=>Yii::$app->security->generatePasswordHash('administrator'),
            'email'=>'admin@example.com',
            'status'=>\worstinme\user\models\User::STATUS_ACTIVE,
        ]);

        $user_id = Yii::$app->db->getLastInsertID();

        $admin = $authManager->createRole('admin');
        $authManager->add($admin);
        $authManager->assign($admin, $user_id);
    }

    public function safeDown()
    {
        $this->delete('{{%user}}', ['username'=>'administrator','email'=>'admin@example.com']);
    }
    
}
