<?php global $options; foreach ($options as $value) {if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }}?>

<?php if ($benzo_lightbox == "Slimbox") {                      
		   $benzo_lightbox_var = 'slimbox';
}
elseif ($benzo_lightbox == "Imagezoom") { 
		 $benzo_lightbox_var = 'imagezoom';
} ?>

<link type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/topnavigation.css" rel="stylesheet" />
<link type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/ReMooz.css" rel="stylesheet" />
<link type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/jd.gallery.css" rel="stylesheet" />
<link type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/<?php echo $benzo_lightbox_var; ?>.css" rel="stylesheet" />
<link type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/mediabox.css" rel="stylesheet" />

<!--[if lt IE 7.]>
<script defer type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/pngfix.js"></script>
<link type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/ie.css" rel="stylesheet" />
<![endif]-->

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/mootools.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/mootools-1.2-more.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/<?php echo $benzo_lightbox_var; ?>.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/box.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/mediabox.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/slider.js">
/***********************************************
* Featured Content Slider- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/
</script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/ReMooz.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jd.gallery.js"></script>

<script type="text/javascript">new UvumiDropdown('dropdown');</script>

<?php if ($benzo_lightbox == "Imagezoom") { ?><script type="text/javascript">window.addEvent("domready", function() {initImageZoom({rel: 'lightbox'});});</script><?php } ?>
<script language="javascript" type="text/javascript">window.addEvent('domready', function(){new MooHover({container:'menu-hover',duration:800});});</script>
