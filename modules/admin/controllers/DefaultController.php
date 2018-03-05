<?php

namespace app\modules\admin\controllers;
use Yii;
use yii\web\Controller;
use app\modules\admin\controllers\BasicController;


class DefaultController extends BasicController
{
    /**
     * 后台主页面
     */
    public function actionIndex()
    {
    	$this->layout = 'default';
        return $this->render('index');
    }
}
