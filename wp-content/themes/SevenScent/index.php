<?php get_header(); ?>

    <div class="contentarea">
            
            <section class="left-contentarea" id="orange">
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
            
            <section class="mid-contentarea">
            </section>


<?php get_footer(); ?>