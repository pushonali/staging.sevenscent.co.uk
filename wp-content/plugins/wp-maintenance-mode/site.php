<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> id="wp_maintenance_mode" >

<head>
	
	<title><?php if ( isset($value['title']) && ($value['title'] != '') ) echo stripslashes_deep( $value['title'] ); else { bloginfo('name'); echo ' - '; _e( 'Maintenance Mode', FB_WM_TEXTDOMAIN ); } ?></title>
	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="author" content="WP Maintenance Mode: Frank Bueltge, http://bueltge.de" />
	<meta name="description" content="<?php bloginfo('name'); echo ' - '; bloginfo('description'); ?>" />
	<meta name="robots" content="noindex,nofollow" />
	<link rel="Shortcut Icon" type="image/x-icon" href="<?php echo get_option('home'); ?>/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="<?php echo WP_PLUGIN_URL . '/' . FB_WM_BASEDIR ?>/css/jquery.countdown.css" media="all" />
	
	<?php
	if ( !defined('WP_CONTENT_URL') )
		define('WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
	if ( !defined('WP_PLUGIN_URL') )
		define( 'WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins' );
	
	if ( !defined('FB_WM_BASENAME') )
		define( 'FB_WM_BASENAME', plugin_basename(__FILE__) );
	if ( !defined('FB_WM_BASEDIR') )
		define( 'FB_WM_BASEDIR', dirname( plugin_basename(__FILE__) ) );
	
	global $locale, $user_ID;
	
	get_currentuserinfo();
	
	if ( defined('WPLANG') )
		$locale = WPLANG;
	if ( empty($locale) )
		$locale = 'en_US';
	
	if ( isset($value['radio']) && 1 === $value['radio'] ) {
		$datetime = explode( ' ', $value['date'] );
		$date = explode( '-', $datetime[0] );
		if ( isset($datetime[1]) )
			$time = explode( ':', $datetime[1] );
		else $time = 0;
		if (count($date) < 3) {
			$date = 0; //ausschalten wegen datum is nicht
		} else {
			$date[1] = $date[1] - 1;
			if (count($time) < 3)
				$time = 0;
			if ( isset($time) && 0 !== $time ) {
				// 'Years', 'Months', 'Weeks', 'Days', 'Hours', 'Minutes', 'Seconds'
				$date = $date[2].', '.$date[1].', '.$date[0].', '.$time[0].', '.$time[1].', '.$time[2];
			} else {
				$date = $date[2].', '.$date[1].', '.$date[0];
			}
		}
	}
	
	wm_head(); ?>
	
</head>

<body>
	
	<div id="header">
		<p><?php if ( isset($value['header']) && ($value['header'] != '') ) echo stripslashes_deep( $value['header'] ); else { bloginfo('name'); echo ' - '; bloginfo('description'); } ?></p>
	</div>

	<div id="content">
		<?php wm_content();
		
		if (isset($user_ID) && $user_ID) {
			$adminlogin    = wp_logout_url();
			if ( isset($rolestatus) && 'norights' == $rolestatus )
				$adminloginmsg = '<h3>' . __( 'Access to the admin area blocked', FB_WM_TEXTDOMAIN ) . '</h3>';
			else
				$adminloginmsg = '';
			$adminloginstr = __( 'Admin-Logout', FB_WM_TEXTDOMAIN );
		} else {
			$adminlogin    = site_url('wp-login.php', 'login');
			$adminloginmsg = '';
			$adminloginstr = __( 'Admin-Login', FB_WM_TEXTDOMAIN );
		} ?>
		
		<h1><?php if ( isset($value['heading']) && ($value['heading'] != '') ) echo stripslashes_deep( $value['heading'] ); else _e( 'Maintenance Mode', FB_WM_TEXTDOMAIN ); ?></h1>
		<?php echo $adminloginmsg; ?>
		<?php if ( 1 === $value['radio'] && 0 !== $date ) {
			$echodate = $datetime[0];
			if ('de_DE' == $locale)
				$echodate = str_replace('-', '.', $datetime[0]);
			if ( 0 !== $time )
			$echodate .= ' ' . $datetime[1];
			?>
		<?php echo sprintf( stripslashes_deep( $value['text']), '<br /><span id="countdown"></span>', $echodate ); ?>
		<?php } else { ?>
		<?php echo sprintf( stripslashes_deep( $value['text'] ), $value['time'], $unit ); ?>
		<?php } ?>
		<div class="admin"><a href="<?php echo $adminlogin; ?>"><?php echo $adminloginstr; ?></a></div>
	</div>
	
	<?php wm_footer(); ?>
	
	<?php
	if ( isset($date) && 0 !== $date ) {

		$locale = substr($locale, 0, 2);
	?>
		<script type="text/javascript" src="<?php bloginfo('url') ?>/wp-includes/js/jquery/jquery.js"></script>
		<script type="text/javascript" src="<?php echo WPMaintenanceMode::get_plugins_url( 'js/jquery.countdown.pack.js', __FILE__ ); ?>"></script>
		<?php if ( WPMaintenanceMode::url_exists( WPMaintenanceMode::get_plugins_url( 'js/jquery.countdown-' . $locale . '.js', __FILE__ ) ) ) { ?>
		<script type="text/javascript" src="<?php echo WPMaintenanceMode::get_plugins_url( 'js/jquery.countdown-' . $locale . '.js', __FILE__ ); ?>"></script>
		<?php } ?>
		<script type="text/javascript">
		jQuery(document).ready( function($){
			var austDay = new Date();
			// 'Years', 'Months', 'Weeks', 'Days', 'Hours', 'Minutes', 'Seconds'
			austDay = new Date(<?php echo $date;  ?>);
			$('#countdown').countdown({until: austDay});
		});
		</script>
	<?php } ?>
</body>
</html>
