<?php global $options; foreach ($options as $value) {if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }}?>

<?php get_header(); ?>

<div class="single_container">

<div class="single_left">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

<p><?php the_content(); ?></p>

<div class="post_single_footer"><span class="post_time"><?php the_time('M j, Y') ?></span><span class="post_cat"><?php the_category(', ') ?></span><span class="post_single_tags"><?php echo get_the_tag_list( '',' - '); ?></span>
</div>	

<?php endwhile; else: ?>
Sorry, no posts matched your criteria.
<?php endif; ?>

<?php if ($benzo_author_info == 'Show') { include (TEMPLATEPATH . '/authorinfo.php'); }?>

<?php comments_template(); ?>
</div>

<div class="single_right"><?php get_sidebar(); ?>
</div>

<div class="clear">
</div>



</div>
<?php get_footer(); ?>
