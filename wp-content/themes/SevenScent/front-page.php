<?php get_header(); ?>

    <div class="contentarea">
            
            <section class="left-contentarea" id="orange">
                <img src="<?php print IMAGES; ?>/homepage.jpg"/>
            </section>
            
            <section class="mid-contentarea">
                <div class="content" id="news">
                    <img src="<?php print IMAGES; ?>/sci.gif"/>
                    <h2>SEVEN NEWS</h2>
                        <?php 
                            $posts_array = get_posts(array( 'numberposts' => 5, 'offset'=> 1, 'category' => 1 )); 
                            foreach($posts_array as $post):
                                echo "<article>
                                    <h1><a href='".get_permalink()."'>".$post->post_title."</a></h1>
                                </article>";
                            endforeach;
                        ?>
                </div><!--content-->
            </section>


<?php get_footer(); ?>