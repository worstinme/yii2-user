<?php

use yii\db\Schema;
use yii\db\Migration;

class m151006_123032_user_auth extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
 
        $this->createTable('{{%user_service}}', [
            'id' => $this->primaryKey(),
            'source' => $this->string(255)->notNull(),
            'source_id' => $this->string(255)->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at'=>$this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {

        $this->dropTable('{{%user_service}}');

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
