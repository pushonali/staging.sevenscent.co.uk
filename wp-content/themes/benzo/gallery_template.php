<?php
/*
Template Name: gallery
*/
?>
<?php global $options; foreach ($options as $value) {if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }}?>


<?php get_header(); ?>
		<script type="text/javascript">
			function startGallery() {
				var myGallery = new gallery($('singlegallery'), {
					timed: false,
					useReMooz: true,
					embedLinks: false
				});
			}
			window.addEvent('domready',startGallery);
		</script>

<div class="single_container">

<div class="single_left">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>


<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

<div id="singlegallery">
				<?php if ($images = get_children(array(
						'post_parent' => $post->ID,
						'post_type' => 'attachment',
						'post_mime_type' => 'image',
						'order' => 'ASC',
						'orderby' => 'menu_order')))  
					foreach($images as $image) {  
						$benzo_image = $image->guid; 
						$benzo_thumb = wp_get_attachment_thumb_url( $image->ID);
						$benzo_title = $image->post_title;
      				    $benzo_description = $image->post_content;?>	

				<div class="imageElement">
					<h3><?php echo $benzo_title; ?></h3>
					<p><?php echo $benzo_description; ?></p>
					<a href="<?php echo $benzo_image; ?>" title="open image" class="open"></a>
					<img src="<?php echo $benzo_image; ?>" class="full" />
					<img src="<?php echo $benzo_thumb; ?>" class="thumbnail" />

					
				</div>


<?php } ?>	

</div>

<p><?php the_content(); ?></p>

<div class="post_single_footer"><span class="post_time"><?php the_time('M j, Y') ?></span>
</div>	

<?php endwhile; else: ?>
Sorry, no posts matched your criteria.
<?php endif; ?>

<?php include (TEMPLATEPATH . '/authorinfo.php'); ?>

<?php comments_template(); ?>
</div>

<div class="single_right"><?php get_sidebar(); ?>
</div>

<div class="clear">
</div>



</div>
<?php get_footer(); ?>
