<?php 

namespace worstinme\user;

use Yii;

class User extends \yii\web\User
{

    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_WAIT = 2;
    
    
}