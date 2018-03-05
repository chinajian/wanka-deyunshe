<?php 
    use yii\helpers\Url;
?>
<script src="<?php echo ADMIN_SITE_URL;?>datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo ADMIN_SITE_URL;?>datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>
<link rel="stylesheet" href="<?php echo ADMIN_SITE_URL;?>datetimepicker/bootstrap-datetimepicker.min.css"/>

<nav class="navbar navbar-default child-nav">
    <h5 class="nav pull-left">修改优惠券</h5>
    <div class="nav pull-right">
        <a href="<?php echo yii\helpers\Url::to(['questions/question-list'])?>" type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-th-list"></span> 优惠券列表</a>
    </div>
</nav>
<form class="form-horizontal" id="modForm">
    <input type="hidden" class="form-control input-sm" name="Questions[qid]" id="qid" placeholder="用户名" value="<?php echo $question['qid']?>">
    <div class="form-group">
        <label for="question" class="col-sm-2 control-label">问题名称<span class="mandatory">*</span></label>
        <div class="col-sm-9">
            <input type="text" class="form-control input-sm" name="Questions[question]" id="question" placeholder="问题名称" value="<?php echo $question['question']?>">
        </div>
    </div>
    <div class="form-group">
        <label for="question" class="col-sm-2 control-label">答案<span class="mandatory">*</span></label>
        <div class="col-sm-9">
            <button type="button" class="btn btn-info" onclick="addQuestion()">增加答案</button>
            <div id="answers">
                <?php $config = ['A', 'B', 'C']?>
                <?php foreach ($answer as $k => $v){?>
                    <div class="radio">
                        <label><input type="radio" name="Answer[answer_id]" id="answer_content<?php echo $k+1?>" value="<?php echo $k+1?>" <?php if($v['is_true'] == 2){?>checked<?php }?>>(<?php echo $config[$k]?>)</label>
                        <input type="text" class="form-control input-sm width-300" style="display: inline-block;" name="Answer[answer_content][]" value="<?php echo $v['answer_content'];?>">
                    </div>
                <?php }?>
            </div>
            <span class="help-block">注意：选中的为正确答案</span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10 col-md-offset-2">
            <button type="reset" class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-repeat"></span> 重置</button>
            <button type="button" class="btn btn-primary btn-sm" id="mod"><span class="glyphicon glyphicon-ok"></span> 提交</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    /*配置*/
    var answersConfig = ['A', 'B', 'C'];
    /*增加答案*/
    function addQuestion()
    {
        var answersLen = $('#answers .radio').length;
        if(answersLen < answersConfig.length){
            $('#answers').append(
                `<div class="radio">
                    <label><input type="radio" name="Answer[answer_id]" id="answer_content`+ (answersLen+1) +`" checked="checked" value="`+ (answersLen+1) +`">(`+ answersConfig[answersLen] +`)</label>
                    <input type="text" class="form-control input-sm width-300" style="display: inline-block;" name="Answer[answer_content][]">
                </div>`
            );
        }else{
            showError('最多添加'+answersConfig.length+'个答案！');
        }
    };

    
    /*修改*/
    $("#mod").click(function(){
        jajax("<?php echo Url::to(['questions/mod-question'])?>", $('#modForm').serialize());
    })
</script>