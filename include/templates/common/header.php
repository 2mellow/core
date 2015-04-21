<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$cms->SITE_NAME?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=$cms->buildMeta($_page, "description")?>">
	<meta name="keywords" content="<?=$cms->buildMeta($_page, "keywords")?>">
	
    <link href="/ui/css/bootstrap.min.css" rel="stylesheet">
    <link href="/ui/css/font.css" rel="stylesheet">
    <link href="/ui/css/design.css" rel="stylesheet">
    <link href="/ui/css/carousel.css" rel="stylesheet">
    <link href="/ui/css/responsive.css" rel="stylesheet">
    
    <script src="/ui/js/jquery.js"></script>
    
    <!--[if lt IE 9]>
      <script src="/ui/js/respond.min.js"></script>
    <![endif]-->
</head>
<body class="page-<?=$cms->url_vars[0]?>">
<div class="navbar-wrapper">
  <div class="container">
    <div class="navbar navbar-inverse navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">2 Mellow CMS</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li<?=$cms->url_vars[0]=="home"?' class="active"':''?>><a href="/">Home</a></li>
            <li<?=$cms->url_vars[0]=="about-us"?' class="active"':''?>><a href="/about-us/">About</a></li>
            <li<?=$cms->url_vars[0]=="article"?' class="active"':''?>><a href="/article/">Blog</a></li>
            <li<?=$cms->url_vars[0]=="example"?' class="active"':''?>><a href="/example/">Example Module</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin Area <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="/admin/">Login</a></li>
                <li><a href="/admin/pages/">Manage Pages</a></li>
                <li><a href="/admin/articles/">Manage Articles</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>