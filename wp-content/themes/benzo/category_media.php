<?php global $options; foreach ($options as $value) {if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }}?>
<?php get_header(); ?>



<div class="cat_container">

	<div class="cat_left">
			<div class="vid_container">
			<?php while (have_posts()) : the_post();  $string = get_post_meta($post->ID, 'yt', true);?>


			<div class="vid_frame">
		

				
				<div class="vid_thumb">
				
					<div class="vid_inner_thumb" style="background: url(http://img.youtube.com/vi/<?php $url = parse_url($string);parse_str($url['query']); echo $v;?>/default.jpg) no-repeat center center; ">
					
						<div id="vid_post" class="MooTrans">
					
							<div class="vid_permalink"><a onmouseover="Tip('<strong><?php the_title(); ?></strong></br>Posted by <?php the_author(); ?> on <?php the_time('M j, Y') ?> with <?php comments_number('0 responses', '1 response', '% responses' );?>')" onmouseout="UnTip()"   href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
							</div>	
						
							<div class="vid_gallery"> <a onmouseover="Tip('Open Video')" onmouseout="UnTip()" rel="mediabox[480 380]" href="http://www.youtube.com/watch?v=<?php $url = parse_url($string);parse_str($url['query']); echo $v;?>" ></a>
							</div>
						
						</div>
						
					</div>
					
				</div>
				
			</div>

				<?php endwhile; ?>

			</div>

	   		<div class="clear">
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
