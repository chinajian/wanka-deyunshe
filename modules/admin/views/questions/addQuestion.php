<?php 
    use yii\helpers\Url;
?>
<nav class="navbar navbar-default child-nav">
    <h5 class="nav pull-left">添加问题</h5>
    <div class="nav pull-right">
        <a href="<?php echo yii\helpers\Url::to(['questions/question-list'])?>" type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-th-list"></span> 问题列表</a>
    </div>
</nav>
<form class="form-horizontal" id="addForm">
    <div class="form-group">
        <label for="question" class="col-sm-2 control-label">问题名称<span class="mandatory">*</span></label>
        <div class="col-sm-9">
            <input type="text" class="form-control input-sm" name="Questions[question]" id="question" placeholder="问题名称">
        </div>
    </div>
    <div class="form-group">
        <label for="question" class="col-sm-2 control-label">答案<span class="mandatory">*</span></label>
        <div class="col-sm-9">
            <button type="button" class="btn btn-info" onclick="addQuestion()">增加答案</button>
            <div id="answers">
<!--                 <div class="radio">
                    <label><input type="radio" name="Answer[answer_id]" id="answer_content1" value="option1" checked>(A)</label>
                    <input type="text" class="form-control input-sm width-300" style="display: inline-block;" name="Answer[answer_content][]">
                </div>
                <div class="radio">
                    <label><input type="radio" name="Answer[answer_id]" id="answer_content2" value="option2">(B)</label>
                    <input type="text" class="form-control input-sm width-300" style="display: inline-block;" name="Answer[answer_content][]">
                </div>
                <div class="radio">
                    <label><input type="radio" name="Answer[answer_id]" id="answer_content3" value="option3">(C)</label>
                    <input type="text" class="form-control input-sm width-300" style="display: inline-block;" name="Answer[answer_content][]">
                </div> -->
            </div>
            <span class="help-block">注意：选中的为正确答案</span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10 col-md-offset-2">
            <button type="reset" class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-repeat"></span> 重置</button>
            <button type="button" class="btn btn-primary btn-sm" id="add"><span class="glyphicon glyphicon-ok"></span> 提交</button>
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

    /*添加*/
    $("#add").click(function(){
        jajax("<?php echo Url::to(['questions/add-question'])?>", $('#addForm').serialize());
    })
</script>