<div class="author">

	
	<div class="author_avatar"><?php echo get_avatar( get_the_author_email(), '60' ); ?>
	</div>
		
	<div class="author_data">
	
			<div class="author_mail"><a href="mailto:<?php the_author_email(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/mail.gif" border="0" alt="Email"/></a>
			</div>
			
			<div class="author_info"><p class="author_name"><?php the_author_firstname(); ?> <?php the_author_lastname(); ?></p>
									 <p class="author_posts"> <a href="<?php bloginfo ('home');?>/index.php?author=<?php the_author_ID(); ?>">View all 
posts by <?php the_author_firstname(); ?> <?php the_author_lastname(); ?> (<?php the_author_posts(); ?>) </a></p>
			</div>
			
			
			
	</div><div style="clear:both; ">
	</div>
	
	<div class="author_description"><?php the_author_description(); ?>
	</div>

</div>