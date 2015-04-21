<?
$salesbarn = new salesbarn();
$plugin = "example";

$pg = $_GET['page'];
if(!is_numeric($pg) || empty($pg)){
	$pg = 1;
}

if($a = $salesbarn->get_from_url($cms->url_vars[1])) { 
$data = array(
	'Breed' => $a->breed,
	'Gender' => $a->gender,
	'Date Foalded' => $a->datefoalded,
	'Height' => $a->height,
	'Weight' => $a->weight,
	'Temperament' => $a->temperament,
	'Reg. Assn' => $a->regassn
);
?>
<span class="innertitle">Sales Barn</span>
<div class="row">
	<? if($a->image){ ?><div class="col-md-4"><img src="/uploads/salesbarn/<?=$a->image?>" alt="<?=$a->horsename?>" class="img-thumbnail img-responsive" /><p><a href="/<?=$plugin?>/">&laquo; Back to Full List</a></div><? } ?>
    <div class="col-md-8">
    	<h1><?=$a->horsename?><? if($a->price){ ?> - $<?=$a->price?><? } ?></h1>
        <div class="well">
            <ul class="salesbarnul">
                <?
                foreach($data as $k=>$li) {
                    if(!empty($li)){
                        echo "<li><strong>".$k.":</strong> ".$li."</li>";
                    }
                }
                ?>
            </ul>
        </div>
        <?=$a->body?>
    </div>
</div>
<? } else if($v = $salesbarn->get_list($pg)) { ?>
<span class="innertitle"><?=$plugin?></span>
<div class="row salesbarnlist">
	<? foreach($v as $a){ ?>
    	<div class="col-md-6">
        	<div class="row">
            	<div class="col-md-4">
                <a href="/salesbarn/<?=$a->clean_url?>/"><img src="/uploads/salesbarn/<?=$a->image?>" alt="<?=$a->horsename?>" class="img-thumbnail img-responsive" /></a>
                </div>
                <div class="col-md-8">
                	<h2><a href="/salesbarn/<?=$a->clean_url?>/"><?=$a->horsename?></a></h2>
                	<div class="well well-sm">
                    	<ul class="salesbarnul-s">
                        	<? if($a->breed){ ?><li><strong>Breed</strong>: <?=$a->breed?></li><? } ?>
                            <? if($a->gender){ ?><li><strong>Gender</strong>: <?=$a->gender?></li><? } ?>
                            <? if($a->datefoalded){ ?><li><strong>Date Foalded</strong>: <?=$a->datefoalded?></li><? } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <? } ?>
</div>
<div class="row">
	<div class="col-md-12">
		<? display_paging_session_html()?>
	</div>
</div>
<? } ?>