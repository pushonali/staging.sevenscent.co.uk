<?php
/*
Template Name: media
*/
?>
<?php global $options; foreach ($options as $value) {if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }}?>

<?php get_header(); ?>

<div class="single_container">

<div class="single_left">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>


 <?php $string = get_post_meta($post->ID, 'yt', true);?>
 
 		<div class="mediasingle_item">
		
			<object width="660" height="400">
			<param name="movie" value="http://www.youtube.com/v/<?php $url = parse_url($string);parse_str($url['query']); echo $v;?>"></param>
			<param name="allowFullScreen" value="true"></param>
			<param name="allowscriptaccess" value="always">
			<param name="wmode" value="transparent">
			</param>
			<embed src="http://www.youtube.com/v/<?php $url = parse_url($string);parse_str($url['query']); echo $v;?>" width="660" height="400" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" movie="http://www.youtube.com/v/<?php $url = parse_url($string);parse_str($url['query']); echo $v;?>" wmode="transparent"></embed>
			</object>		
		
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
