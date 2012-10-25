<?php
get_header();

global $post;

$rightsideimg = get_post_meta( $post->ID, 'right_side_image', true );
if( empty( $rightsideimg ) )
	$rightsideimg = "http://www.sevenscent.co.uk/wp-content/uploads/seven_scent_tall.png";
?>

<div class="single_container<?php if( empty( $rightsideimg ) ): ?> page_container<?php endif; ?>">

<div class="single_left">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

<p><?php the_content(); ?></p>

<?php endwhile; else: ?>
Sorry, no posts matched your criteria.
<?php endif; ?>

</div>

<?php if( !empty( $rightsideimg ) ): ?>
<div class="single_right">
<?php
	echo '<img src="'.$rightsideimg.'" alt="*" />';
?>
</div>
<?php endif; ?>

<div class="clear">
</div>

</div>
<?php get_footer(); ?>
