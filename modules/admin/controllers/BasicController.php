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
                        "name" => '系统设置',
                        "icon" => '',
                        "m" => 'Admin',
                        "c" => 'set_sys',
                        "a" => 'index',
                        "data" => '',
                    ),array(
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
            array(
                "name" => '题库管理',
                "icon" => 'cog',
                "m" => 'Admin',
                "c" => 'questions',
                "a" => 'question-list',
                "data" => '',
                "children" => [
                    array(
                        "name" => '题库列表',
                        "icon" => '',
                        "m" => 'Admin',
                        "c" => 'questions',
                        "a" => 'question-list',
                        "data" => '',
                    )
                ]
            ),
            array(
                "name" => '会员管理',
                "icon" => 'cog',
                "m" => 'Admin',
                "c" => 'user',
                "a" => 'user-list',
                "data" => '',
                "children" => [
                    array(
                        "name" => '会员列表',
                        "icon" => '',
                        "m" => 'Admin',
                        "c" => 'user',
                        "a" => 'user-list',
                        "data" => '',
                    ),array(
                        "name" => '答题日志',
                        "icon" => '',
                        "m" => 'Admin',
                        "c" => 'user',
                        "a" => 'answer_log',
                        "data" => '',
                    ),array(
                        "name" => '成功日志',
                        "icon" => '',
                        "m" => 'Admin',
                        "c" => 'user',
                        "a" => 'success_log',
                        "data" => '',
                    ),array(
                        "name" => '求助日志',
                        "icon" => '',
                        "m" => 'Admin',
                        "c" => 'user',
                        "a" => 'help_log',
                        "data" => '',
                    ),
                ]
            ),
        ];
        return true;
    }

    /*图片上传*/

}
