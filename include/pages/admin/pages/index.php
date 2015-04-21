<?
if($post['delete']){
	foreach($post['delete'] as $k=>$v){
		$db->execute("DELETE FROM `pages` WHERE id = ?",array($k));
		$feedback->add("delete successful",'success');	
		//get the children and set their parent to 0 so if you delete a parent 
		$children = $cms->get_cms_pages_children($k);
		if($children){
			foreach($children as $child){
				$data = array('parent' => 0);
				$db->dbinsert($data, 'pages', $child->id);
			}
		} 
	}
		
}
if($post['order'] && !$post['delete']){
	foreach($post['order'] as $k=>$v){
		if(is_numeric($v)){
			$data = array(
				'order' => $v
			);
			$db->dbinsert($data, 'pages', $k);
			
		}else{
		$feedback->add('order value must be numeric');
		}
	}
	if(!$feedback->is_error())
		$feedback->add("updated order",'success');
}

$pages = $cms->get_cms_pages_parents();
$feedback->generate_html();
?>
<h1>Content Pages</h1>
<form method="post" action="" id="pagesform" style="margin-bottom:0px;">
<div class="row" style="padding:10px 0px;">
    <div class="col-sm-12" style="text-align:right">
    	<a class="btn btn-default btn-sm" href="/admin/pages/manage/"><span class="glyphicon glyphicon-file"></span> Add Page</a> 
        <button class="btn btn-info btn-sm ordersubmit" disabled="disabled"><span class="glyphicon glyphicon-check"></span> Save Order</button> 
        <button class="btn btn-danger btn-sm deletebutton" disabled="disabled"><span class="glyphicon glyphicon-trash"></span> Delete</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    <table class="table table-bordered table-condensed vert-middle" style="margin-bottom:10px;">
        <tbody>
        <tr>
            <td width="20" class="text-center"><input class="checkall" type="checkbox" id="delete[<?=$v->id?>]" /></td>
            <td><strong>Title</strong></td>
            <td width="120"><strong>Order</strong></td>
        </tr>
        <?
        if($pages){
            foreach($pages as $v){
                ?>
                <tr>
                    <td class="text-center"><input name="delete[<?=$v->id?>]" class="deletecheckbox" type="checkbox" id="delete[<?=$v->id?>]" /> </td>
                    <td><a href="/admin/pages/manage/<?=$v->id?>"><?=$v->title?></a></td>
                    <td><input name="order[<?=$v->id?>]" type="text" value="<?=$v->order?>" class="form-control input-sm orderinput" /></td>
                </tr>
                <?	
                //Get the children and make a tr for each
                $children = $cms->get_cms_pages_children($v->id);
                if($children != false){
                    foreach($children as $c){
                        ?>
                        <tr class="" style="background-color:#f3f3f3;">
                            <td class="text-center"><input name="delete[<?=$c->id?>]"  class="deletecheckbox" type="checkbox" id="delete[<?=$c->id?>]" /> </td>
                            <td><a href="/admin/pages/manage/<?=$c->id?>">-- <?=$c->title?></a></td>
                            <td><input name="order[<?=$c->id?>]" type="text" value="<?=$c->order?>" class="form-control input-sm orderinput" /></td>
                        </tr>
                        <?
                    }
                }
            }
        }
        ?>
        </tbody>
    </table>
    </div>
</div>
</form>
<script type="text/javascript">
$(document).ready(function (){	
	$(".orderinput").click(function(){
		$(".ordersubmit").prop('disabled', false);
	});
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