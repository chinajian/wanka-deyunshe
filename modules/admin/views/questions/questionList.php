<?php 
    use yii\helpers\Url;
?>
<nav class="navbar navbar-default child-nav">
	<h5 class="nav pull-left">问题列表</h5>
	<div class="nav pull-right">
		<a href="<?php echo yii\helpers\Url::to(['questions/add-question'])?>" type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-plus"></span> 添加问题</a>
	</div>
</nav>
<div class="table-responsive">
	<table class="table table-bordered table-hover table-condensed table-striped">
		<thead>
			<tr class="active">
				<th class="text-center width-50">ID</th>
				<th style="width: 20%">问题</th>
				<th style="width: 40%">答案</th>
				<th>最后修改时间</th>
				<th>创建时间</th>
				<th class="text-center width-150">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($questionList as $k => $v){?>	
			<tr>
				<td class="text-center"><?php echo $v['qid'];?></td>
				<td><?php echo $v['question'];?></td>
				<td>
					<?php 
						foreach($v['answer'] as $k1 => $v1){
							if($v1['is_true'] == 2){
								echo '<span class="label label-success">'.$v1['answer_content'].'</span> ';
							}else{
								echo '<span class="label label-default">'.$v1['answer_content'].'</span> ';
							}
						}
					?>
				</td>
				<td><?php echo $v['last_modify_time']?date('Y-m-d H:i:s', $v['last_modify_time']):'';?></td>
				<td><?php echo $v['create_time']?date('Y-m-d H:i:s', $v['create_time']):'';?></td>
				<td class="text-center" data-id="<?php echo $v['qid'];?>">
					<button type="button" class="btn btn-danger btn-xs del"><span class="glyphicon glyphicon-remove"></span> 删除</button>
					<a href="<?php echo Url::to(['questions/mod-question', 'id' => $v['qid']])?>" type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil"></span> 修改</a>
				</td>
			</tr>
			<?php }?>
		</tbody>
		<tfoot class="pages">
			<tr>
				<td class="pagelist noselect text-right" colspan="11"></td>
			</tr>
		</tfoot>
	</table>
</div>
<script type="text/javascript">
	/*删除问题*/
	confirmation($('.del'), function(){
		var self = $(".popover").prev();
		self.confirmation('hide');
		var id = self.parent().data("id");
		if(id){
			var data = {
				'id': id
			}
			jajax('<?php echo Url::to(['questions/del-question'])?>', data);
		}
	});

	/*分页*/
	var page = new Paging();
	page.init({
		target: $('.pagelist'),
		pagesize: <?php echo $pageInfo['pageSize']?$pageInfo['pageSize']:1;?>,
		count: <?php echo $pageInfo['count']?>,
		// toolbar: true,
		hash: true,
		current: <?php echo $pageInfo['currPage']?>,
		pageSizeList: [5, 10, 15, 20 ,50],
		changePagesize: function(currPage){
			window.location.href = "<?php echo Url::to(['questions/question-list'])?>&page=" + currPage;
		},
		callback: function (currPage, size, count) {
			window.location.href = "<?php echo Url::to(['questions/question-list'])?>&page=" + currPage;
		}
	});
</script>