<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
<?php if(is_home()) { echo bloginfo('name'); } else { wp_title(''); } ?>
</title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all" />
<link rel="shorcut icon" href="/wp-content/themes/benzo/images/favicon.ico" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
<?php global $options; foreach ($options as $value) {if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }}?>
<?php include (TEMPLATEPATH . '/gate/gate.php'); ?>
</head>
<body <?php body_class(); ?>>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/tooltip.js"> </script>
<div class="top">

<div class="logo"><a href="/" title="Seven Scent"><img src="/wp-content/themes/benzo/images/seven-logo.png" alt="Seven Scent" width="155" height="88" /></a></div>
  <div class="top_navigation">
  	<form action="/" method="get" class="search-box">
    	<input class="search-box-txt" type="text" name="s" value="" />
        <input class="search-box-btn" type="image" name="submit" value="" src="/wp-content/themes/benzo/images/topsearch.png" />
    </form>
    <ul id="dropdown" class="dropdown">
      <li class="page-item-home"><a href="<?php bloginfo('home'); ?>">Home</a></li>
      <?php
      	$menu = wp_list_pages('sort_column=menu_order&title_li=&echo=0&link_before=&link_after=&depth=1');
		$menu = explode( "</li>", $menu );
		$i = 0;
		foreach( $menu as $item ):
			if( $i != 5 ):
			if( $i == 4 )
				echo '<li class="page-item-blog"><a href="/blog/">Blog</a></li>';
				
			echo $item . "</li>";
			endif;
			$i++;
		endforeach;
	  ?>
    </ul>
  </div>
</div>