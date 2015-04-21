<?
if($id = $cms->url_vars[3])
	$page = $cms->get_cms_pages($id);
?>
<table width="100%" style="background-color:transparent">
	<tr>
		<td><h1>Pages</h1></td>
    	<td align="right">
        	<? if(!empty($page)){ ?><a class="btn btn-default btn-sm" href="<?=$cms->build_link($page->id)?>" target="_blank"><span class="glyphicon glyphicon-new-window"></span> Preview</a><? } ?>
        </td>
    </tr>
</table>
<h3 style="padding-bottom:15px;"><?=empty($page->title)?'Add New Page':'Currently Editing: '.$page->title?></h3>
<? $feedback->generate_html() ?>
    <form method="post" enctype="multipart/form-data" action="#" role="form">
        <div class="row">
            <div class="col-sm-6">
            	<div class="form-group">
                    <label for="title">* Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter Page Title" value="<?=$page->title?$page->title:$_SESSION['post']['title']?>">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="clean_url">* Clean URL</label>
                    <input type="text" name="clean_url" id="clean_url" class="form-control" placeholder="Clean text for URL" value="<?=$page->clean_url?$page->clean_url:$_SESSION['post']['clean_url']?>">
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-sm-6">
            	<div class="row">
                	<div class="col-sm-6">
                        <div class="form-group">
                            <label for="title">Heading</label>
                            <input type="text" name="heading" id="heading" class="form-control" placeholder="Enter Page Title" value="<?=$page->heading?$page->heading:$_SESSION['post']['heading']?>">
                        </div>
                	</div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="title">Sub Heading</label>
                            <input type="text" name="sub_heading" id="sub_heading" class="form-control" placeholder="Enter Sub Heading" value="<?=$page->sub_heading?$page->sub_heading:$_SESSION['post']['sub_heading']?>">
                        </div>
                	</div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="parent">Parent</label>
                    <select name="parent" id="parent" class="form-control">
                        <option value="0">-- Is Parent --</option>
                        <?=$cms->gen_page_options($page->{'parent'})?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
            	<div class="form-group">
                	<label for="parent">Meta Keywords</label>
                    <textarea class="form-control" id="meta_keywords" name="meta_keywords"><?=$page->meta_keywords?$page->meta_keywords:$_SESSION['post']['meta_keywords']?></textarea>
                </div>
            </div>
            <div class="col-sm-6">
            	<div class="form-group">
                	<label for="parent">Meta Description</label>
                    <textarea class="form-control" id="meta_description" name="meta_description"><?=$page->meta_description?$page->meta_description:$_SESSION['post']['meta_description']?></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="ckeditor" name="content" id="content">
                        <? if($page){
                            echo $page->content;
						} else if($_SESSION['post']['content']){
							echo $_SESSION['post']['content'];
                        } else {
                            echo "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi a nisi id erat mollis placerat. Etiam vel felis sed sapien auctor egestas. Sed ac lorem ut tortor sagittis porta. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas quam lacus, porta non fermentum at, interdum a nibh. Donec commodo blandit auctor. Pellentesque lectus nisl, molestie non tempus vel, volutpat at risus. Morbi vestibulum dapibus magna, in blandit velit interdum sed. Nulla vitae magna ante, et varius dui. Aenean eu orci odio. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.</p>";
                        } ?>
                    </textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <input name="id" type="hidden" value="<?=$id?>" />
                <input name="action" type="hidden" id="action" value="pages.manage" />
                <button type="submit" class="btn btn-info btn-large pull-right"><span class="glyphicon glyphicon-check"></span> Save Page</button>
            </div>
        </div>
	</form>
<script type="text/javascript">
$('#title').keyup(function(){
	var ref = $(this).val().toLowerCase().replace(/[^a-z0-9]+/g,'-');
	$('#clean_url').val(ref);
});
</script>