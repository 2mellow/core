<?
$plugin = "example";
$example = new example();

if($id = $cms->url_vars[3])
	$item = $example->get($id);
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
<form method="post" enctype="multipart/form-data" action="#" role="form">
<div class="row">
    <div class="col-sm-9">
		<? $feedback->generate_html() ?>
        <div class="row">
    		<div class="col-sm-6">
                <div class="form-group">
                    <label for="title">* Name</label>
                    <input type="text" name="horsename" id="horsename" class="form-control" placeholder="Enter Horse Name" value="<?=$item->horsename?$item->horsename:$_SESSION['post']['horsename']?>">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="title">Breed</label>
                    <input type="text" name="breed" id="breed" class="form-control" placeholder="Enter Breed" value="<?=$item->breed?$item->breed:$_SESSION['post']['breed']?>">
                </div>
            </div>
        </div>
        
        <div class="row">
    		<div class="col-sm-6">
                <div class="form-group">
                    <label for="title">Gender</label>
                    <select name="gender" id="gender" class="form-control">
                    	<?
							$options = array("Gelding", "Mare", "Stud");
							foreach($options as $option){
								if($option == $item->gender || $option == $_SESSION['post']['gender']){
									$selected = " selected='selected'";
								} else {
									$selected = "";
								}
								echo '<option value="'.$option.'"'.$selected.'>'.$option.'</option>';
							}
						?>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="title">Date Foalded</label>
                    <input type="text" name="datefoalded" id="datefoalded" class="form-control" placeholder="Enter Date Foalded" value="<?=$item->datefoalded?$item->datefoalded:$_SESSION['post']['datefoalded']?>">
                </div>
            </div>
        </div>
        
        <div class="row">
    		<div class="col-sm-6">
                <div class="form-group">
                    <label for="title">Price</label>
                    <input type="text" name="price" id="price" class="form-control" placeholder="Enter Price" value="<?=$item->price?$item->price:$_SESSION['post']['price']?>">
                </div>
            </div>
            <div class="col-sm-6">
            	<div class="row">
                	<div class="col-sm-6">
                        <div class="form-group">
                            <label for="title">Height</label>
                            <input type="text" name="height" id="height" class="form-control" placeholder="Enter Height" value="<?=$item->height?$item->height:$_SESSION['post']['height']?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                    	<div class="form-group">
                            <label for="title">Weight</label>
                            <input type="text" name="weight" id="weight" class="form-control" placeholder="Enter Weight" value="<?=$item->weight?$item->weight:$_SESSION['post']['weight']?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
    		<div class="col-sm-6">
                <div class="form-group">
                    <label for="title">Temperament</label>
                    <select name="temperament" id="temperament" class="form-control">
                    	<?
							$options = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
							foreach($options as $option){
								if($option == $item->temperament || $option == $_SESSION['post']['temperament']){
									$selected = " selected='selected'";
								} else {
									$selected = "";
								}
								echo '<option value="'.$option.'"'.$selected.'>'.$option.'</option>';
							}
						?>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="title">Reg. Assn</label>
                    <input type="text" name="regassn" id="regassn" class="form-control" placeholder="Enter Reg. Assn" value="<?=$item->regassn?$item->regassn:$_SESSION['post']['regassn']?>">
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label for="body">Description</label>
            <textarea class="ckeditor" name="body" id="body">
                <? if($item->body){
                    echo $item->body;
                } else if ($_SESSION['post']['body']){
                    echo $_SESSION['post']['body'];
                } else {
                    echo "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi a nisi id erat mollis placerat. Etiam vel felis sed sapien auctor egestas. Sed ac lorem ut tortor sagittis porta. </p>";
                } ?>
            </textarea>
        </div>
    </div>
    <div class="col-sm-3">
    	<div class="form-group">
            <input name="id" type="hidden" value="<?=$id?>" />
            <input name="action" type="hidden" id="action" value="<?=$plugin?>.manage" />
            <button type="submit" class="btn btn-info btn-large btn-block"><span class="glyphicon glyphicon-check"></span> Save Horse</button>
        </div>
        <div class="well well-sm">
        	<?
			if($item->date_created){
				$d = $item->date_created;
			} else {
				$d = time();
			}
			?>
        	<p><strong>Date Created:</strong><br /><?=date("m.d.Y", $d)?></p>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status">
                	<?
                    if($item->status){
						$status = $item->status;
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
        <div class="form-group">
            <label for="image">Image:</label>
            <? if($item->image) { ?>
            	<div class="well well-sm"><img src="/uploads/example/<?=$item->image?>" class="img-responsive" /></div>
            <? } ?>
            <input type="file" id="image" name="image">
            <p class="help-block">File must be gif, jpg or png</p>
        </div>
        <div>
        	<a href="/admin/<?=$plugin?>">&laquo; View All</a>
        </div>
    </div>
</div>
</form>

<? emptyArray("post") ?>
