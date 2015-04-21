<?
$plugin = "events";
$events = new events();

if($post['delete']){
	foreach($post['delete'] as $k=>$v){
		$db->execute("DELETE FROM `".$plugin."` WHERE id = ?",array($k));
		$feedback->add("Delete successful",'success');
	}
}

$pages = $events->get_list(get_page_number(), false, "/admin/".$plugin."/");
$feedback->generate_html();
?>
<h1><?=ucwords($plugin)?></h1>
<form method="post" action="" id="pagesform" style="margin-bottom:0px;">
<div class="row" style="padding:10px 0px;">
    <div class="col-sm-12" style="text-align:right">
    	<a class="btn btn-default btn-sm" href="/admin/<?=$plugin?>/manage/"><span class="glyphicon glyphicon-file"></span> Add New</a> 
        <button class="btn btn-danger btn-sm deletebutton" disabled="disabled" onclick="confirm('Are you sure you wish to delete?')"><span class="glyphicon glyphicon-trash"></span> Delete</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    <table class="table table-bordered table-condensed vert-middle" style="margin-bottom:10px;">
        <tbody>
        <tr>
            <td width="20" class="text-center"><input class="checkall" type="checkbox" id="delete[<?=$v->id?>]" /></td>
            <td><strong>Event Name</strong></td>
            <td width="130"><strong>Date Created</strong></td>
        </tr>
        <?
        if($pages){
            foreach($pages as $v){
                ?>
                <tr>
                    <td class="text-center"><input name="delete[<?=$v->id?>]" class="deletecheckbox" type="checkbox" id="delete[<?=$v->id?>]" /> </td>
                    <td><a href="/admin/<?=$plugin?>/manage/<?=$v->id?>/"><?=$v->title?></a></td>
                    <td><?=date("m.d.Y", $v->date_created)?></td>
                </tr>
            <? }
        } ?>
        </tbody>
    </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
		<? display_paging_session_html()?>
	</div>
</div>
</form>
<script type="text/javascript">
$(document).ready(function (){
	$(".deletecheckbox").click(function(){
		if ($("#pagesform input:checkbox:checked").length > 0){
			$(".deletebutton").prop('disabled', false);
		} else {
			$(".deletebutton").prop('disabled', true);
		}
	});
	$('.checkall').click(function () {
        $(this).parents('fieldset:eq(0)').find(':checkbox').attr('checked', this.checked);
		if ($("#pagesform input:checkbox:checked").length > 0){
			$(".deletebutton").prop('disabled', false);
		} else {
			$(".deletebutton").prop('disabled', true);
		}
    });
});
</script>