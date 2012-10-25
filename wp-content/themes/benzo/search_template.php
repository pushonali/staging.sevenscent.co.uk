<?php
/*
Template Name: Search
*/
?>

<?php global $options; foreach ($options as $value) {if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }}?>
<?php get_header(); ?>



<div class="cat_container">

	<div class="cat_left">
				<div class="search_container">
		

		
			<form id="searchform" method="get" action="<?php bloginfo('home'); ?>/index.php">
		   
				 <input class="searchform_form_nomatch" type="text" name="s" id="s" size="15" />
				 <input class="searchform_button_form_nomatch" type="submit" value="Search" />
		
			 </form>

	</div>
	<?php while (have_posts()) : the_post(); ?>
			 <?php if ($images = get_children(array(
				'post_parent' => $post->ID,
				'numberposts' => '1',
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'order' => 'ASC',
				'orderby' => 'menu_order')))  
			 foreach($images as $image) {  
				$exehill_image = $image->guid; 
				$exehill_thumb = wp_get_attachment_thumb_url( $image->ID);			
				} else {
				$exehill_thumb = site_url('/wp-content/themes/benzo/images/noimage_cat.png');
				} ?>



<div class="blog_container">



	<div class="blog_top" style="background: url(<?php echo $exehill_thumb; ?>) no-repeat; "> <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"></a>
	
	</div>
	
	<div class="blog_content">
	
		<div class="blog_headline">
		
			<span class="blog_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_time('M j, Y') ?> / <?php the_title(); ?></a></span> 
			
			
			
		</div>
		
		<div class="blog_excerpt"><?php the_excerpt(); ?><span><a href="<?php the_permalink() ?>">Learn more &rarr;</a></span>
		</div>
	
	</div>
	
	<div class="clear">
	</div>


	
</div>

		
	<?php endwhile; ?>
<div class="pagnav">
<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
</div>
</div>
	
<div class="cat_right"><?php get_sidebar(); ?>
</div>
	
	<div class="clear">
	</div>
	
</div>



<?php get_footer(); ?>
