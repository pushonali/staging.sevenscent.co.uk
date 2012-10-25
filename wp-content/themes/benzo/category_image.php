<?php global $options; foreach ($options as $value) {if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }}?>
<?php get_header(); ?>



<div class="cat_container">

	<div class="cat_left">
			<div class="image_container">

		

			
			 <?php while (have_posts()) : the_post(); 
			if ($images = get_children(array(
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
				$exehill_image = site_url('/wp-content/themes/benzo/images/noimage.png');
				$exehill_thumb = site_url('/wp-content/themes/benzo/images/noimage.png');
				}				
			    ?>



			<div class="image_frame">
		

				
				<div class="image_thumb">
				
					<div class="image_inner_thumb" style="background: url(<?php echo $exehill_thumb; ?>) no-repeat center center; ">
					
						<div id="image_post" class="MooTrans">
					
							<div class="image_permalink"><a onmouseover="Tip('<strong><?php the_title(); ?></strong></br>Posted by <?php the_author(); ?> on <?php the_time('M j, Y') ?> with <?php comments_number('0 responses', '1 response', '% responses' );?>')" onmouseout="UnTip()"   href="<?php the_permalink(); ?>"></a>
							</div>	
						
							<div class="image_gallery"> <a onmouseover="Tip('Open Image')" onmouseout="UnTip()" rel="lightbox[boxset]"  href="<?php echo $exehill_image; ?>" ></a>
							</div>
						
						</div>
						
					</div>
					
				</div>
				
			</div>
				<?php endwhile; ?>

			

	   		<div class="clear">
			</div>
			
		</div>

	


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
