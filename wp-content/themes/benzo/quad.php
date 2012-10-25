<?php global $options; foreach ($options as $value) {if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }}?>


			 <?php $temp_query = clone $wp_query; 
			  query_posts('category_name=news&showposts=3');
			
			  while (have_posts()) : the_post();
			  if ($images = get_children(array(
				'post_parent' => $post->ID,
				'numberposts' => '1',
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'order' => 'ASC',
				'orderby' => 'menu_order')))  
			 foreach($images as $image) {  
				$benzo_image = $image->guid; 
				$benzo_thumb = wp_get_attachment_thumb_url( $image->ID);			
				} else {
				$benzo_image = site_url('/wp-content/themes/benzo/images/noimage.png');
				} ?>

<div class="quad_item"><h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
					<div class="quad_excerpt"><?php the_excerpt(); ?><span><a href="<?php the_permalink() ?>">Learn more &rarr;</a></span>
					</div>
					
					<div class="quad_thumb" style="background: url(<?php echo $benzo_image; ?>) no-repeat; "><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"></a>
					</div>
</div>

<?php endwhile; $wp_query = clone $temp_query; ?>

<div class="quad_itemspeciale">
	<ul id="quad_catlist">
		<div class="quad_cats">
			<h5><?php wp_list_categories('include=' . $benzo_cat_one. '&title_li='); ?></h5>
			<p class="quad_cats_text"><?php echo category_description('' . $benzo_cat_one . ''); ?></p>
			
		</div>
	</ul>
	
	<ul id="quad_catlist">
		<div class="quad_cats">
			<h5><?php wp_list_categories('include=' . $benzo_cat_two . '&title_li='); ?></h5>
			<p class="quad_cats_text"><?php echo category_description('' . $benzo_cat_two . ''); ?></p>
			
		</div>
	</ul>
	
	<ul id="quad_catlist">
		<div class="quad_cats">
			<h5><?php wp_list_categories('include=' . $benzo_cat_three . '&title_li='); ?></h5>
			<p class="quad_cats_text"><?php echo category_description('' . $benzo_cat_three . ''); ?></p>
			
		</div>
	</ul>
	
	<ul id="quad_catlist">
		<div class="quad_cats">
			<h5><?php wp_list_categories('include=' . $benzo_cat_four . '&title_li='); ?></h5>
			<p class="quad_cats_text"><?php echo category_description('' . $benzo_cat_four . ''); ?></p>
			
		</div>
	</ul>


</div>
<div class="clear">
</div>