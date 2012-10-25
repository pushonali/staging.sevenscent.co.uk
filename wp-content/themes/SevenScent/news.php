<?php /* Template Name: Green Theme */ ?>


<?php get_header(); ?>

    <div class="contentarea" id="news">
            
            <section class="left-contentarea" id="green">
                <div class="content">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    
                    <div class="post group">
                        <h2><?php the_title(); ?></h2>
                        <?php the_content('Read More...'); ?>
                    </div>
                    
                    <?php endwhile; else: ?>
                        <p><?php _e('No posts were found. Sorry!'); ?></p>
                    <?php endif; ?>
                </div><!--content-->
            </section>
            
            <div class="devider" id="green"></div>
            
            <section class="mid-contentarea">
            </section>

        
<?php get_footer(); ?>