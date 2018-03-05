<?php

namespace app\modules\admin\controllers;

use yii;
use yii\web\Controller;
use libs\AdminInfo;


class BasicController extends Controller
{
    public $layout = 'default';

    public function beforeAction($action)
    {
        /*验证登录*/
        if(!AdminInfo::getIsLogin()){
            $this->redirect(['public/login']);
            Yii::$app->end();
        }

        /*取出菜单*/
        $this->view->params['menu'] = [
            array(
                "name" => '系统设置',
                "icon" => 'cog',
                "m" => 'Admin',
                "c" => 'manager',
                "a" => 'manager-list',
                "data" => '',
                "children" => [
                    array(
                        "name" => '管理员列表',
                        "icon" => '',
                        "m" => 'Admin',
                        "c" => 'manager',
                        "a" => 'manager-list',
                        "data" => '',
                    ),array(
                        "name" => '操作日志',
                        "icon" => '',
                        "m" => 'Admin',
                        "c" => 'syslog',
                        "a" => 'index',
                        "data" => '',
                    ),
                ]
            ),
            // array(
            //     "name" => '优惠券管理',
            //     "icon" => 'cog',
            //     "m" => 'Admin',
            //     "c" => 'set',
            //     "a" => 'index',
            //     "data" => '',
            //     "children" => [
            //         array(
            //             "name" => '优惠券列表',
            //             "icon" => '',
            //             "m" => 'Admin',
            //             "c" => 'set',
            //             "a" => 'index',
            //             "data" => '',
            //         ),array(
            //             "name" => '优惠券礼包',
            //             "icon" => '',
            //             "m" => 'Admin',
            //             "c" => 'set',
            //             "a" => 'index',
            //             "data" => '',
            //         ),array(
            //             "name" => '领取日志',
            //             "icon" => '',
            //             "m" => 'Admin',
            //             "c" => 'set',
            //             "a" => 'index',
            //             "data" => '',
            //         ),
            //     ]
            // ),
        ];
        return true;
    }

    /*图片上传*/

}
