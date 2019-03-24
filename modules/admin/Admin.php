<?php

namespace app\modules\admin;
use Yii;
use yii\filters\AccessControl;
use app\models\User;
/**
 * admin module definition class
 */
class Admin extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [User::USER_STATUS_ADMIN]
                    ]
                ]
            ]
        ];
    }
}
//    public function init()
//    {
//        parent::init();
//
//        // custom initialization code goes here
//    }
