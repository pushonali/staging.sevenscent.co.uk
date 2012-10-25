            
            <section class="right-contentarea">
               <img src="<?php print IMAGES; ?>/logo.jpg" />
            </section>
            
            <div class="clear"></div>        
        </div><!--contentarea-->        
        
        <div class="clear"></div>
    </div><!--wrapper-->
    
    
    <footer>
        <p>&copy; Copyright <?php echo bloginfo("name") . " " . date("Y"); ?></p>
        <?php wp_nav_menu( array('menu' => 'Footernav', 'container' =>'nav' )); ?>                     
    </footer>

<?php wp_footer(); ?>    
    
</body>

</html>