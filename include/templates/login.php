<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?=$cms->SITE_NAME?> | Admin Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    
	<link href="/ui/css/bootstrap.min.css" rel="stylesheet">
    <link href="/ui/css/font.css" rel="stylesheet">
    <link href="/ui/css/login.css" rel="stylesheet">
    
    <script src="/ui/js/jquery.js"></script>
    
    <!--[if lt IE 9]>
      <script src="/ui/js/respond.min.js"></script>
    <![endif]-->
    
  </head>
<body class="<?=$cms->url_vars[0]?>">
<div class="container">
<? $feedback->generate_html() ?>
  <form class="form-signin" role="form" action="" method="post">
    <h2 class="form-signin-heading">Please sign in</h2>
    <p>Username is: <strong>demo@2mellow.com</strong><br />Password is: <strong>demo</strong></p>
    <input type="email" class="form-control" placeholder="Email address" name="email" value="demo@2mellow.com" required autofocus>
    <input type="password" class="form-control" placeholder="Password" name="pass" value="demo" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <input name="action" type="hidden" id="action" value="login" />
  </form>
</div>
<script src="/ui/js/bootstrap.min.js"></script>
</body>
</html>