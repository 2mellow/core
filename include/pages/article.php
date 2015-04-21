<?

$pg = $_GET['page'];
if(!is_numeric($pg) || empty($pg)){
	$pg = 1;
}

//are we trying to call an article
if($a = $articles->get_from_url($cms->url_vars[1])) { ?>
	<h1><?=$a->title?></h1>
    <h6>Date Created: <?=date("m/d/Y", $a->date_created)?></h6>
    <hr />
    <div><?=$a->body?></div>
    <hr />
    <a href="/article/">&laquo; Archives</a>
<? } else if($v = $articles->get_list($pg)) { ?>
	<h1>Article Archives</h1>
    <hr />
	<div class="archive_item">
	<? foreach($v as $a){ ?>
    	<h4><a href="/article/<?=$a->clean_url?>/"><?=$a->title?></a></h4>
        <h6>Date Created: <?=date("m/d/Y", $a->date_created)?></h6>
        <div><p><?=text_trim(strip_tags($a->body), 120)?> <a href="/article/<?=$a->clean_url?>/">Read More &raquo;</a></p></div>
        <hr />
    <? } ?>
    </div>
    <? display_paging_session_html()?>
<? } else { ?>
	<span class="innertitle">We're Sorry</span>
	<h1>No Articles have been posted, yet.</h1>
    <p>Thank you for checking but we have not yet posted any articles. Please check back again later!</p>
<? } ?>