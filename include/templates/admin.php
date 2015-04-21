<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?=$cms->SITE_NAME?> | Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    
	<link href="/ui/css/bootstrap.min.css" rel="stylesheet">
    <link href="/ui/css/font.css" rel="stylesheet">
    <link href="/ui/css/admin.css" rel="stylesheet">
    <link href="/ui/js/jqueryui/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
    
    <script src="/ui/js/jquery.js"></script>
    <script src="/ui/js/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="/ui/js/ckeditor/ckeditor.js"></script>
    
    <!--[if lt IE 9]>
      <script src="/ui/js/respond.min.js"></script>
    <![endif]-->
  </head>
<body class="<?=$cms->url_vars[0]?>">

<div class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="/admin/" class="navbar-brand"><?=$cms->SITE_NAME?></a>
    </div>
    <div class="navbar-collapse collapse">
		<?
			$plugins = array(
				"Example Module" => "example",
				"Events" => "events"
			);
		?>
      <ul class="nav navbar-nav navbar-right">
        <li<?=$cms->url_vars[0]=="admin"&&empty($cms->url_vars[1])?' class="active"':''?>><a href="/admin/">Dashboard</a></li>
        <li<?=$cms->url_vars[1]=="pages"?' class="active"':''?>><a href="/admin/pages/">Pages</a></li>
        <li<?=$cms->url_vars[1]=="articles"?' class="active"':''?>><a href="/admin/articles/">Articles</a></li>
        <? if(!empty($plugins)){ ?>
        <li class="dropdown<?=in_array($cms->url_vars[1], $plugins)?' active':''?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Plugins <b class="caret"></b></a>
        	<ul class="dropdown-menu">
            	<? foreach($plugins as $k=>$v){ ?>
            	<li<?=$cms->url_vars[1]==$v?' class="active"':''?>><a href="/admin/<?=$v?>/"><?=$k?></a></li>
                <? } ?>
            </ul>
        </li>
        <? } ?>
        <li><a href="/"><span class="glyphicon glyphicon-off"></span></a></li>
      </ul>
    </div>
  </div>
</div>
<div class="container" style="padding:70px 15px;">
    <div class="row">
        <div class="col-sm-12">
          <?=$__output__?>
        </div>
    </div>
</div>
<script src="/ui/js/bootstrap.min.js"></script>
</body>
</html>