<div id="sidebar">

  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
			


      <div id="sidebarwidget">
        <h5><?php _e('Categories'); ?></h5>
          <ul>
            <?php wp_list_cats('sort_column=name&optioncount=1&hierarchical=0'); ?>
          </ul>
      </div>



      <div id="sidebarwidget">
        <h5><?php _e('Archives'); ?></h5>
          <ul>
            <?php wp_get_archives('type=monthly'); ?>
          </ul>
      </div>



      <div id="sidebarwidget">
        <h5><?php _e('Links'); ?></h5>
          <ul>
            <?php get_links('-1', '<li>', '</li>', '<br />', FALSE, 'id', FALSE, FALSE, -1, FALSE); ?>
          </ul>
      </div>


      <div id="sidebarwidget">
        <h5>Meta</h5>
          <ul>
              <li class="rss"><a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a></li>
              <li class="rss"><a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a></li>
              <li class="wordpress"><a href="http://www.wordpress.org" title="Powered by WordPress">WordPress</a></li>
              <li class="login"><?php wp_loginout(); ?></li>
          </ul>
      </div>


  <?php endif; ?>
</div>