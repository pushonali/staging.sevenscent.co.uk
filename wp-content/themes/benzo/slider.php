<?php global $options; foreach ($options as $value) {if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }}?>
<?php $temp_query = clone $wp_query; ?>
<?php query_posts('meta_key=featured_image&showposts=10&post_type=page&orderby=date&order=ASC'); ?>

<div class="coda_inner">
  <div class="coda_rotator">
    <div id="slider" class="sliderwrapper">
      <?php while (have_posts()) : the_post();
	  
	  global $post;
	  $featured_image = get_post_meta( $post->ID, 'featured_image', true );
	  if( empty( $featured_image ) )
	  	$featured_image = site_url('/wp-content/themes/benzo/images/coda_noimage.png');
 ?>
      <div class="contentdiv">
        <div class="coda_image" style="background: url(<?php echo $featured_image; ?>) no-repeat; "><a  href="<?php the_permalink(); ?>" class="toc"></a> </div>
      </div>
      <?php endwhile; $wp_query = clone $temp_query; ?>
    </div>
  </div>
  <div id="paginate-slider" class="coda_pagination">
    <?php $temp_query = clone $wp_query;  
			 query_posts('meta_key=featured_image&showposts=10&post_type=page&orderby=date&order=ASC');
			 while (have_posts()) : the_post();
			 
	  global $post;
	  $featured_thumb = get_post_meta( $post->ID, 'featured_image', true );
	  if( empty( $featured_thumb ) )
		$featured_thumb = site_url('/wp-content/themes/benzo/images/mininoimage.png');
	
			    ?>
    <div onmouseover="Tip('<strong><?php the_title(); ?></strong>')" onmouseout="UnTip()"><a href="<?php the_permalink(); ?>" class="toc"><img src="<?php echo $featured_thumb; ?>" alt="Thumb" title="title" style="width:38px; height:23px; "/></a></div>
    <?php endwhile; $wp_query = clone $temp_query; ?>
  </div>
  <div class="coda_left_bottom"><a href="<?php echo $benzo_slidelink_url; ?>"><?php echo $benzo_slidelink_text; ?></a></div>
  <script type="text/javascript">
featuredcontentslider.init({
	id: "slider", 
	contentsource: ["inline", ""],  
	toc: "markup",  
	nextprev: ["Previous", "Next"], 
	revealtype: "mouseover",
	enablefade: [true, 0.2],  
	autorotate: [<?php echo $benzo_slider_rotation; ?>, <?php echo $benzo_slider_duration; ?>],  
	onChange: function(previndex, curindex){ 
	}
})
</script>
</div>
<?php $wp_query = clone $temp_query; ?>