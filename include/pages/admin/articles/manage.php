<?
$plugin = "articles";

if($id = $cms->url_vars[3])
	$article = $articles->get($id);
?>
<table width="100%" style="background-color:transparent">
	<tr>
		<td><h1><?=ucwords($plugin)?></h1></td>
    	<td align="right">
        	<? if(!empty($article)){ ?><a class="btn btn-default btn-sm" href="/article/<?=$article->clean_url?>/" target="_blank"><span class="glyphicon glyphicon-new-window"></span> Preview</a><? } ?>
        </td>
    </tr>
</table>
<h3 style="padding-bottom:15px;"><?=empty($article->title)?'Add New':'Currently Editing: '.$article->title?></h3>
<form method="post" enctype="multipart/form-data" action="#" role="form">
<div class="row">
    <div class="col-sm-9">
		<? $feedback->generate_html() ?>
        <div class="form-group">
            <label for="title">* Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Page Title" value="<?=$article->title?$article->title:$_SESSION['post']['title']?>">
        </div>
        <div class="form-group">
            <label for="clean_url">* Clean URL</label>
            <input type="text" name="clean_url" id="clean_url" class="form-control" placeholder="Unique URL" value="<?=$article->clean_url?$article->clean_url:$_SESSION['post']['clean_url']?>">
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea class="ckeditor" name="body" id="body">
                <? if($article->body){
                    echo $article->body;
                } else if ($_SESSION['post']['body']){
                    echo $_SESSION['post']['body'];
                } else {
                    echo "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi a nisi id erat mollis placerat. Etiam vel felis sed sapien auctor egestas. Sed ac lorem ut tortor sagittis porta. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas quam lacus, porta non fermentum at, interdum a nibh. Donec commodo blandit auctor. Pellentesque lectus nisl, molestie non tempus vel, volutpat at risus. Morbi vestibulum dapibus magna, in blandit velit interdum sed. Nulla vitae magna ante, et varius dui. Aenean eu orci odio. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.</p>";
                } ?>
            </textarea>
        </div>
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Advanced</a></h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse out">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="parent">Meta Keywords</label>
                                    <textarea class="form-control" id="meta_keywords" name="meta_keywords"><?=$article->meta_keywords?$article->meta_keywords:$_SESSION['post']['meta_keywords']?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="parent">Meta Description</label>
                                    <textarea class="form-control" id="meta_description" name="meta_description"><?=$article->meta_description?$article->meta_description:$_SESSION['post']['meta_description']?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
    	<div class="form-group">
            <input name="id" type="hidden" value="<?=$id?>" />
            <input name="action" type="hidden" id="action" value="articles.manage" />
            <button type="submit" class="btn btn-info btn-large btn-block"><span class="glyphicon glyphicon-check"></span> Save Article</button>
        </div>
        <div class="well well-sm">
        	<?
			if($article->date_created){
				$d = $article->date_created;
			} else {
				$d = time();
			}
			?>
        	<p><strong>Date Created:</strong><br /><?=date("m.d.Y", $d)?></p>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status">
                	<?
                    if($article->status){
						$status = $article->status;
					} else if ($_SESSION['post']['status']){
						$status = $_SESSION['post']['status'];
					} else {
						$status = "published";
					}
					?>
                	<option value="published"<?=$status=="published"?' selected="selected"':''?>>Published</option>
                    <option value="private"<?=$status=="private"?' selected="selected"':''?>>Private</option>
                    <option value="disabled"<?=$status=="disabled"?' selected="selected"':''?>>Disabled</option>
                </select>
            </div>
        </div>
        <div>
        	<a href="/admin/<?=$plugin?>">&laquo; View All</a>
        </div>
    </div>
</div>
</form>

<? emptyArray("post") ?>
<script type="text/javascript">
$('#title').keyup(function(){
	var ref = $(this).val().toLowerCase().replace(/[^a-z0-9]+/g,'-');
	$('#clean_url').val(ref);
});
</script>