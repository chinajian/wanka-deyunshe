<?php

namespace app\modules\admin\models;

use Yii;
use libs\AdminInfo;

class SysConfig extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return '{{%sys_config}}';
    }

    public function rules()
    {
        return [
            ['limit_time', 'integer', 'message' => '答题时间必须为正整数'],
            ['help_opportunitys', 'integer', 'message' => '救助机会必须为正整数'],
            ['begin_time', 'required', 'message' => '活动开始时间不能为空'],
            ['begin_time', 'integer', 'message' => '活动开始时间必须为正整数'],
            ['end_time', 'required', 'message' => '活动结束时间不能为空'],
            ['end_time', 'integer', 'message' => '活动结束时间必须为正整数'],
        ];
    }

    /*更新 系统配置*/
    public function set($data)
    {
        if(isset($data['SysConfig']['begin_time']) and !empty($data['SysConfig']['begin_time'])){
            $data['SysConfig']['begin_time'] = strtotime($data['SysConfig']['begin_time']);
        }
        if(isset($data['SysConfig']['end_time']) and !empty($data['SysConfig']['end_time'])){
            $data['SysConfig']['end_time'] = strtotime($data['SysConfig']['end_time']);
        }

        if($this->load($data) and $this->validate()){
            $sysConfig = self::find()->one();
            if(is_null($sysConfig)){
               return false; 
            }
            $sysConfig->limit_time = $data['SysConfig']['limit_time'];
            $sysConfig->help_opportunitys = $data['SysConfig']['help_opportunitys'];
            $sysConfig->begin_time = $data['SysConfig']['begin_time'];
            $sysConfig->end_time = $data['SysConfig']['end_time'];
            if($sysConfig->save(false)){
                /*写入日志*/
                SysLog::addLog('修改系统参数成功');
                return true;
            }
        }
        return false;
    }

    /*取出 货币符号*/
    public static function getCurrency()
    {
        // $sysConfig = self::find()->select('currency')->where('conf_id = :conf_id', [':conf_id' => AdminInfo::getCompanyId()])->one();
        // if(is_null($sysConfig)){
        //    return ''; 
        // }
        // return $sysConfig['currency'];
    }


}
