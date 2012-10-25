<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php bloginfo('name'); ?> | <?php wp_title(); ?></title>
    
    <!--[if lt IE 9]> <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    

    
    <?php wp_head(); ?>
    
</head>

<body>

    <div class="wrapper left-tab right-tab">
        <header>
            <?php wp_nav_menu( array('menu' => 'Mainmenu', 'container' =>'nav' )); ?>
            <div class="clear"></div>
        </header>