<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title?></title>

    <link rel="stylesheet" href="<?=url();?>/template/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=url();?>/template/assets/icon/style.css"/>
    <link rel="stylesheet" href="<?=url();?>/template/assets/css/style.css"/>
    
</head>
<body>
    <main class="main">
        <?=$v->section("content")?>
    </main>

    <script src="<?=url();?>/template/assets/js/jquery.min.js"></script>
    <script src="<?=url();?>/template/assets/js/bootstrap.min.js"></script>
    <script src="<?=url();?>/template/assets/js/index.js"></script>
<?php 
    if($v->section("script")):
        echo $v->section("script");
    endif;
?>
</body>
</html>