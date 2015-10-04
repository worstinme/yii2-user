<?php 

namespace worstinme\user;

use Yii;

class User extends \yii\web\User
{

    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_WAIT = 2;

    const ROLE_USER = 1;
    const ROLE_MODER = 5;
    const ROLE_ADMIN = 10;


    public function isAdmin()
    {
        return $this->identity->role == self::ROLE_ADMIN ? true : false; 
    }

}