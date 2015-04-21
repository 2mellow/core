<?
$plugin = "events";
$events = new events();

if($id = $cms->url_vars[3])
	$item = $events->get($id);

if($_GET['deleteeventdate'])
	$db->execute("DELETE FROM `event_dates` WHERE `id` = ?", array($_GET['deleteeventdate']));
?>
<table width="100%" style="background-color:transparent">
	<tr>
		<td><h1><?=ucwords($plugin)?></h1></td>
    	<td align="right">
        	<? if(!empty($item)){ ?><a class="btn btn-default btn-sm" href="/<?=$plugin?>/<?=$item->clean_url?>/" target="_blank"><span class="glyphicon glyphicon-new-window"></span> Preview</a><? } ?>
        </td>
    </tr>
</table>
<h3 style="padding-bottom:15px;"><?=empty($item->title)?'Add New':'Currently Editing: '.$item->title?></h3>
<? $feedback->generate_html() ?>
<form method="post" enctype="multipart/form-data" action="#" role="form">
<div class="row">
    <div class="col-sm-6">
    	<div class="form-group">
            <label for="title">* Event Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Page Title" value="<?=$item->title?$item->title:$_SESSION['post']['title']?>">
        </div>
    </div>
    <div class="col-sm-6">
    	<div class="form-group">
            <label for="contact_name">Contact Name</label>
            <input type="text" name="contact_name" id="contact_name" class="form-control" placeholder="Enter Contact Name" value="<?=$item->contact_name?$item->contact_name:$_SESSION['post']['contact_name']?>">
        </div>
    </div>
    
    
    <div class="col-sm-6">
    	<div class="form-group">
            <label for="contact_email">Contact Email</label>
            <input type="text" name="contact_email" id="contact_email" class="form-control" placeholder="Enter Contact Email" value="<?=$item->contact_email?$item->contact_email:$_SESSION['post']['contact_email']?>">
        </div>
    </div>
    <div class="col-sm-6">
    	<div class="form-group">
            <label for="contact_phone">Contact Phone</label>
            <input type="text" name="contact_phone" id="contact_phone" class="form-control" placeholder="Enter Contact Phone" value="<?=$item->contact_phone?$item->contact_phone:$_SESSION['post']['contact_phone']?>">
        </div>
    </div>
    
    
    <div class="col-sm-6">
    	<div class="form-group">
            <label for="location">Location and Time</label>
            <textarea class="form-control" id="location" name="location" rows="3"><?=$item->location?$item->location:$_SESSION['post']['location']?></textarea>
        </div>
    </div>
    <div class="col-sm-6">
    	<div class="row" id="dateitems">
        	<? if($items = $events->get_dates($id)) { 
				$num=1; ?>
				<? foreach($items as $k => $i){ ?>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="date_<?=$num?>">* Date <?=$num?></label><a class="btn btn-danger btn-xs btn-xxs pull-right" href="/admin/<?=$plugin?>/manage/<?=$id?>?deleteeventdate=<?=$i->id?>" onclick="confirm('Are you sure you wish to delete?')"><span class="glyphicon glyphicon-remove"></span></a>
                            <input type="text" name="event_date[<?=$num?>]" id="date_<?=$num?>" class="form-control datepicker" placeholder="Add Date" value="<?=$i->event_date?>">
                        </div>
                    </div>
                <? $num++; } ?>
            <? } else { ?>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="date_1">* Date</label>
                        <input type="text" name="event_date[1]" id="date_1" class="form-control datepicker" placeholder="Add Date" value="">
                    </div>
                </div>
            <? } ?>    
        </div>
        <div class="form-group">
        	<button type="button" id="add_date" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-plus"></span> Add Date</button>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-sm-12">
    	<label for="description">Description</label>
        <textarea class="ckeditor" name="description" id="description">
            <? if($item->description){
                echo $item->description;
            } else if ($_SESSION['post']['description']){
                echo $_SESSION['post']['description'];
            } else {
                echo "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi a nisi id erat mollis placerat. Etiam vel felis sed sapien auctor egestas. Sed ac lorem ut tortor sagittis porta.</p>";
            } ?>
        </textarea>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
    	<div class="form-group">
            <input name="id" type="hidden" value="<?=$id?>" />
            <input name="action" type="hidden" id="action" value="<?=$plugin?>.manage" />
            <button type="submit" class="btn btn-info btn-large pull-right"><span class="glyphicon glyphicon-check"></span> Save Page</button>
        </div>
    </div>
</div>
</form>

<? emptyArray("post") ?>
<? if(!$num)$num=1;?>
<script>
$(document).ready(function (){
	num = <?=$num?>;
	$('#add_date').click(function () {
		num++;
		html = '<div class="col-sm-4" id="di-'+num+'" style="display:none">\
			<div class="form-group">\
				<label for="date_'+num+'">* Date '+num+'</label>\
                <input type="text" name="event_date['+num+']" id="date_'+num+'" class="form-control datepicker" placeholder="Add Date" value="">\
			</div>\
		</div>';
		$('#dateitems').append(html);
		$('#di-'+num).fadeIn('slow');
	});
});
$('body').on('focus',".datepicker", function(){
	$(".datepicker").datepicker();
});
</script>