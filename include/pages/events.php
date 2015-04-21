<?
$events = new events();

$pg = $_GET['page'];
if(!is_numeric($pg) || empty($pg)){
	$pg = 1;
}
?>
<span class="innertitle">NW Horse Park Events</span>
<? if($a = $events->get_from_url($cms->url_vars[1])) { 
$data = array(
	'Contact Name' => $a->contact_name,
	'Contact Email' => "<a href='mailto:".$a->contact_email."'>".$a->contact_email."</a>",
	'Contact Phone' => $a->contact_phone,
	'Location and Time' => nl2br($a->location)
);
?>
	<div class="row">
    	<div class="col-md-12">
            <div class="well" style="padding-bottom:0px;">
            	<h1 style=""><?=$a->title?></h1>
                <hr />
            	<div class="row">
                	<? if($items = $events->get_dates($a->id)) { ?>
                        <div class="col-md-6">
                            <strong>Date<?=count($items)>1?'s':''?>:</strong>
                            <div style="padding-bottom:15px;">
							<? foreach($items as $k => $i){ ?>
                                <button type="button" class="btn btn-default btn-xs">
                                  <span class="glyphicon glyphicon-calendar"></span> <?=$i->event_date?>
                                </button>
                            <? } ?>
                            </div>
                        </div>
                    <? } ?>
                	<? foreach($data as $k => $i){ ?>
    				<div class="col-md-6">
                    	<strong><?=$k?>:</strong><p style="line-height:20px;"><?=$i?></p>
                    </div>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-12">
        	<?=$a->description?>
        </div>
    </div>
<? } else { ?>
	<? if($ev = $events->get_front_list()) {
		foreach($ev as $e) { 
			$main = $events->get($e->parent_id);
			if($prev !== $e->event_date){ ?>
				<div class='event_date'>
				<div class='midline'></div>
				<div class='eventtitle'><?=date("l, F j, Y", strtotime($e->event_date))?></div>
				</div>
			<? } ?>
            <div class="eventlistinfo">
            	<h1><a href="/events/<?=$main->clean_url?>/"><?=$main->title?></a></h1>
                <p><?=text_trim(strip_tags($main->description), 40)?></p>
            </div>
		<? $prev = $e->event_date;
    	}
	} ?>
<? } ?>