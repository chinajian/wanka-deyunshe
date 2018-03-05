<?php 
    use yii\helpers\Url;
?>
<script src="<?php echo ADMIN_SITE_URL;?>datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo ADMIN_SITE_URL;?>datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>
<link rel="stylesheet" href="<?php echo ADMIN_SITE_URL;?>datetimepicker/bootstrap-datetimepicker.min.css"/>

<nav class="navbar navbar-default child-nav">
    <h5 class="nav pull-left">系统设置</h5>
</nav>
<form class="form-horizontal" id="sysForm">
    <div class="form-group">
        <label for="limit_time" class="col-sm-2 control-label">答题时间限制</label>
        <div class="col-sm-9">
            <input type="text" class="form-control input-sm" name="SysConfig[limit_time]" id="limit_time" placeholder="答题时间限制" value="<?php echo $sysConfig['limit_time']?>">
            <span class="help-block">在规定时间内完成答题,以 “秒” 为单位，0为不限制</span>
        </div>
    </div>
    <div class="form-group">
        <label for="help_opportunitys" class="col-sm-2 control-label">求助次数</label>
        <div class="col-sm-9">
            <input type="text" class="form-control input-sm" name="SysConfig[help_opportunitys]" id="help_opportunitys" placeholder="求助次数" value="<?php echo $sysConfig['help_opportunitys']?>">
        </div>
    </div>
    <div class="form-group">
        <label for="begin_time" class="col-sm-2 control-label">活动开始时间</label>
        <div class="col-sm-9">
            <input type="text" class="form-control input-sm form_datetime" name="SysConfig[begin_time]" id="begin_time" placeholder="活动开始时间" value="<?php echo $sysConfig['begin_time']?date('Y-m-d H:i', $sysConfig['begin_time']):''?>" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="end_time" class="col-sm-2 control-label">活动结束时间</label>
        <div class="col-sm-9">
            <input type="text" class="form-control input-sm form_datetime" name="SysConfig[end_time]" id="end_time" placeholder="活动结束时间" value="<?php echo $sysConfig['end_time']?date('Y-m-d H:i', $sysConfig['end_time']):''?>" readonly>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10 col-md-offset-2">
            <button type="button" class="btn btn-primary btn-sm" id="mod"><span class="glyphicon glyphicon-ok"></span> 提交</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    /*创建日期*/
    $('.form_datetime').datetimepicker({
        language:  'zh-CN',
        format: "yyyy-mm-dd hh:ii",
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        minView: 0,
        maxView: 1
    });

    /*修改*/
    $("#mod").click(function(){
        jajax("<?php echo Url::to(['set_sys/index'])?>", $('#sysForm').serialize());
    })
</script>