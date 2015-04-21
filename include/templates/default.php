<? include($cms->DIR_COMMON_TEMPLATES."header.php") ?>
<div class="container" style="padding-top:100px;">
    <h1><?=$_page->{'heading'}?></h1>
    <h2><?=$_page->sub_heading?></h2>
    <?=$__output__?>
    <? include($cms->DIR_COMMON_TEMPLATES."footer.php") ?>
</div>
<script src="/ui/js/bootstrap.min.js"></script>
<script src="/ui/js/misc.js"></script>
</body>
</html>