<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\modules\admin\controllers\BasicController;
use app\modules\admin\models\SysConfig;
use app\models\Album;


class Set_sysController extends BasicController
{
    /**
     * 系统设置
     */
    public function actionIndex()
    {
    	/*如果有数据，进行修改*/
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $sysConfigModel = new SysConfig;
            if($sysConfigModel->set($post)){
                return showRes(200, '修改成功');
                Yii::$app->end();
            }else{
                if($sysConfigModel->hasErrors()){
                    return showRes(300, $sysConfigModel->getErrors());
                }else{
                    return showRes(300, '修改失败');
                }
            }
            return;
        }

        $sysConfig = SysConfig::find()->asArray()->one();
    	return $this->render('index', [
            'sysConfig' => $sysConfig
        ]);

    }



}
