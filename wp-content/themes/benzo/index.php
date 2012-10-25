<?php get_header(); ?>

<div class="slider_container">
  <?php include (TEMPLATEPATH . '/slider.php'); ?>
</div>
<div class="quad_container">
  <?php
	// Get three random pages
	query_posts('showposts=3&post_type=page&orderby=menu_order&meta_key=home_page_thumb&order=asc');
	
	// Display the pages in blocks
	while (have_posts()) : the_post(); 
	global $post;
	$pageimg = get_post_meta( $post->ID, 'home_page_thumb', true );
	$pageintro = get_post_meta( $post->ID, 'home_page_intro', true );
	$pagetitle = get_post_meta( $post->ID, 'home_page_title', true );
?>
  <div class="quad_item">
    <h3><a href="<?= the_permalink() ?>" rel="bookmark" title="Permanent Link to <?= the_title(); ?>">
      <?php
	  if( !empty( $pagetitle ) ):
	  	echo $pagetitle;
	  else:
		the_title();
	  endif;
	  ?>
      </a></h3>
    <div class="quad_excerpt">
      <?php
	  if( !empty( $pageintro ) ):
	  	echo nl2br( $pageintro );
	  else:
		the_advanced_excerpt();
	  endif;
	  ?>
      <span><a href="<?php the_permalink() ?>">Read more &rarr;</a></span> </div>
    <div class="quad_thumb" style="background: url(<?= $pageimg; ?>) no-repeat; "><a href="<?= the_permalink() ?>" rel="bookmark" title="Permanent Link to <?= the_title(); ?>"></a> </div>
  </div>
<?php
	endwhile;
	
	// Reset the query
	wp_reset_query();
	
	
	/*foreach( $pages as $p ):

	endforeach;*/
	
	// Get the latest blog articles
//	$posts = get_posts('numberposts=2&category=1');
	query_posts('showposts=2&post_type=post&cat=1');
	
	// Display the posts in a block
?>
  <div class="quad_item quad_post">
    <h3>Latest News</h3>
    <ul>
      <?php
	//foreach( $posts as $p ):
	while (have_posts()) : the_post();
?>
      <li> <h4><a href="<?php the_permalink() ?>">
        <?= the_title() ?>
        </a></h4>
    <div class="quad_excerpt">
      <?= the_advanced_excerpt('length=10') ?>
      <span><a href="<?php the_permalink() ?>">Read more &rarr;</a></span>
    </div></li>
      <?php
	endwhile;
?>
    </ul>
  </div>
  <div class="clear"> </div>
</div>
<?php get_footer(); ?>