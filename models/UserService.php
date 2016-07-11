<?php

namespace worstinme\user\models;

use Yii;

/**
 * This is the model class for table "{{%user_service}}".
 *
 * @property integer $id
 * @property string $source
 * @property string $source_id
 * @property integer $user_id
 * @property integer $created_at
 */
class UserService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_service}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['source', 'source_id', 'user_id'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['source', 'source_id'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'source' => 'Source',
            'source_id' => 'Source ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
               $this->created_at = time();
            }
            return true;
        }
        return false;
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
}
