<?php
get_header();

global $post;

$rightsideimg = get_post_meta( $post->ID, 'right_side_image', true );
if( empty( $rightsideimg ) )
	$rightsideimg = "http://www.sevenscent.co.uk/wp-content/uploads/seven_scent_tall.png";
?>

<div class="single_container<?php if( empty( $rightsideimg ) ): ?> page_container<?php endif; ?>">

<div class="single_left">

<h1>Error 404 - Page Not Found</h1>

<p>Unfortunately this page could not be found.</p>

<script type="text/javascript">
  var GOOG_FIXURL_LANG = 'en-GB';
  var GOOG_FIXURL_SITE = 'http://www.sevenscent.co.uk'
</script>
<script type="text/javascript"
  src="http://linkhelp.clients.google.com/tbproxy/lh/wm/fixurl.js">
</script>

</div>

<div class="single_right">
<?php
	echo '<img src="'.$rightsideimg.'" alt="*" />';
?>
</div>

<div class="clear">
</div>

</div>
<?php get_footer(); ?>