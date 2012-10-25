<?php 

//----------------------------------------------------Sidebar

if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => '<div id="sidebarwidget">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>',
    ));

	register_sidebar(array('name'=>'footerbar',
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<div id="foothead">',
		'after_title' => '</div>',
		));
	
		
//----------------------------------------------------Categories
function desc_cats(){
foreach (get_categories(array('hide_empty'=>true)) as $category)
{
$catid = $category->cat_ID;
echo '<div class="quad_cats"><h5><a href="' . get_bloginfo('wpurl') . '/category/' .  $category->category_nicename . '/">' .
	$category->cat_name . ' (' . $category->count.$numposts.')</a></h5><p class="quad_cats_text">' . category_description($catid) . '</p></div>' . "\n";
}
};

	
//----------------------------------------------------Excerpt
	
function improved_trim_excerpt($text) {
	global $post;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
		$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
		$text = strip_tags($text, '<p>');
		$excerpt_length = 20;
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words)> $excerpt_length) {
			array_pop($words);
			array_push($words, '');
			$text = implode(' ', $words);
		}
	}
	return $text;
}
	
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'improved_trim_excerpt');	




add_filter('the_content', 'mmwrel_replace', 12);
add_filter('get_comment_text', 'mmwrel_replace');
function mmwrel_replace ($content)
{   global $post;
	$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
    $replacement = '<a$1href=$2$3.$4$5 rel="lightbox['.$post->ID.']"$6>$7</a>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}
 

function one_comment($comment, $args, $depth) { 
$GLOBALS['comment'] = $comment; ?>  
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">  
	<div class="comment_arrow"></div>
	
	 <div class="comment_inner">
	 
		<div id="comment-<?php comment_ID(); ?>">  
			<div class="comment_frame"> 
			 
				<div class="comment_avatar"><?php echo get_avatar($comment,$size='46',$default='<path_to_url>' ); ?>
				</div>
				
				<div  class="comment_author_top">
				
							<p class="comment_author_say"><?php printf(__('<cite class="comment_title">%s says:</cite>'), get_comment_author_link()) ?>
							</p>
							
							<p class="comment_date"><a href="<?php echo htmlspecialchars(get_comment_link( $comment->comment_ID )) ?>">  <?php printf(__('%1$s at %2$s '), get_comment_date(),get_comment_time()) ?></a>
							</p>  
				
				</div>
				  
				<div  class="comment_data_right"><?php edit_comment_link(__(' Edit '),'  ','') ?>   <?php comment_reply_link(array_merge( $args, array('reply_text' => ' Reply', 'add_below' =>$add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				</div>
				
				<div class="clear">
				</div>
			
			</div> 
			 
			
			<?php if ($comment->comment_approved == '0') : ?>  
			<em><?php _e('Your comment is awaiting moderation.') ?></em>  
			<br />  
			<?php endif; ?>  
	  	  
			<div class="comment_text"><?php comment_text() ?>
			</div> 
			<?php if($args['max_depth']!=$depth) { ?>  
			<?php } ?>  
		  </div> 
		</div>


<?php  
}  


//----------------------------------------------------Settings

$themename = "Benzo";
$shortname = "benzo";
$options = array (



//---------------------------------------------------------------Image Settings

array(   "name" => "Category Box",
         "type" => "title_line"),


array(  "name" => "First Category Link",
        "desc" => "Enter category ID (i.e. 3). <a href=\"http://www.wplancer.com/how-to-find-a-wordpress-category-id/\" target=\"_blank\" title=\"Find category ID\">Help</a>",
        "id" => $shortname."_cat_one",
        "std" => "1",
        "type" => "text"),
		
array(  "name" => "Second Category Link",
        "desc" => "Enter category ID (i.e. 3). <a href=\"http://www.wplancer.com/how-to-find-a-wordpress-category-id/\"  target=\"_blank\" title=\"Find category ID\">Help</a>",
        "id" => $shortname."_cat_two",
        "std" => "1",
        "type" => "text"),
		
array(  "name" => "Third Category Link",
        "desc" => "Enter category ID (i.e. 3). <a href=\"http://www.wplancer.com/how-to-find-a-wordpress-category-id/\"  target=\"_blank\" title=\"Find category ID\">Help</a>",
        "id" => $shortname."_cat_three",
        "std" => "1",
        "type" => "text"),
		
array(  "name" => "Fourth Category Link",
        "desc" => "Enter category ID (i.e. 3). <a href=\"http://www.wplancer.com/how-to-find-a-wordpress-category-id/\" target=\"_blank\"  title=\"Find category ID\">Help</a>",
        "id" => $shortname."_cat_four",
        "std" => "1",
        "type" => "text"),
		
array(    "type" => "close"),


array(   "name" => "Slider Link",
         "type" => "title_line"),


array(  "name" => "Text",
        "desc" => "Type in some text to display in the slider bottom bar",
        "id" => $shortname."_slidelink_text",
        "std" => "",
        "type" => "text"),
		
array(  "name" => "Second Category Link",
        "desc" => "Type in URL",
        "id" => $shortname."_slidelink_url",
        "std" => "",
        "type" => "text"),
		

		
array(    "type" => "close"),
//---------------------------------------------------------------Cat Settings

		 
array(   "name" => "Global Settings",
         "type" => "title_line"),

		
array(  "name" => "Lightbox",
        "desc" => "Choose lightbox script",
        "id" => $shortname."_lightbox",
        "std" => "Slimbox",
		"options" => array("Slimbox", "Imagezoom"),
        "type" => "select"),
		
array(  "name" => "Slider Autorotation",
        "desc" => "Enable to autorotate slider",
        "id" => $shortname."_slider_rotation",
        "std" => "false",
		"options" => array("false", "true"),
        "type" => "select"),
		
array(  "name" => "Slider Autorotation Duration",
        "desc" => "Enter in milli seconds (1000ms = 1s)",
        "id" => $shortname."_slider_duration",
        "std" => "3000",
        "type" => "text"),

array(  "name" => "Logo",
        "desc" => "http://yourdomain.com/path/to/image.png (250px x 90px)",
        "id" => $shortname."_theme_logo",
        "std" => "",
        "type" => "text"),
		
array(  "name" => "Footer Mini Logo",
        "desc" => "http://yourdomain.com/path/to/image.png (30px x 30px)",
        "id" => $shortname."_theme_mini_logo",
        "std" => "",
        "type" => "text"),
		
array(  "name" => "Google Analytics",
        "desc" => "<a href=\"http://www.google.com/analytics/\" title=\"Get an ID\">Google Analytics account ID (UA-1234567-0)</a>",
        "id" => $shortname."_google_analytics",
        "std" => "",
        "type" => "text"),
		
array(  "name" => "Author Info",
        "desc" => "Enable post author info",
        "id" => $shortname."_author_info",
        "std" => "Show",
		"options" => array("Show", "Hide"),
        "type" => "select"),
		
array(  "name" => "Footer",
        "desc" => "Add some text or HTML to footer",
        "id" => $shortname."_footer_text",
        "std" => "",
        "type" => "textarea"),
		
array(    "type" => "close")


);

function mytheme_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {

        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=functions.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=functions.php&reset=true");
            die;

        }
    }

    add_theme_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');

}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';

?>
<div class="wrap">
<h2><?php echo $themename; ?> settings</h2>

<form method="post">

<?php foreach ($options as $value) {

switch ( $value['type'] ) {

case "open":
?>
<table width="100%" border="0" style=" padding:10px;">

<?php break;

case "close":
?>

</table><br />

<?php break;

case "title":
?>
<table width="100%" border="0" style=" padding:5px 5px;">
<tr>
    <td colspan="2"><h3 style="font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
</tr>

<?php break;

case "title_line":
?>
<table width="900px" border="0" style="border:1px solid #CCCCCC; background-color: #FFFFFF; padding:5px 10px; font:Arial, Helvetica, sans-serif;">
<tr>
    <td colspan="2" style="font-size:26px; "><h3 style="font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
</tr>

<?php break;

case 'text':
?>

<tr>
    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
    <td width="80%"><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
</tr>

<tr>
    <td><small><?php echo $value['desc']; ?></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px solid #E4E4E4;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php
break;

case 'textarea':
?>

<tr>
    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
    <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?></textarea></td>

</tr>

<tr>
    <td><small><?php echo $value['desc']; ?></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px solid #E4E4E4;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php
break;

case 'select':
?>
<tr>
    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
    <td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select></td>
</tr>

<tr>
    <td><small><?php echo $value['desc']; ?></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px solid #E4E4E4;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php
break;

case 'select_line':
?>
    <td width="240px"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select></td>
</tr>

<tr style="margin-bottom:0px; background-color:#FFFFFF">
    <td><small><?php echo $value['desc']; ?></small></td>
</tr>
<tr>
<td colspan="2" style="margin-bottom:5px;border-bottom:1px solid #E4E4E4;">&nbsp;</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>

</tr>
<?php break;

case 'text':
?>

<tr>
    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
    <td width="80%"><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
</tr>

<tr>
    <td><small><?php echo $value['desc']; ?></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px solid #E4E4E4;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php break;

case 'text_line':
?>

<tr style="margin-bottom:0px; background-color:#FFFFFF">
    <td width="100px" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
    <td width="200px"><input style="width:200px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /></td>


<?php break;

case 'text_custom':
?>


    <td width="200px"><input style="width:200px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /></td>

<?php
break;

case "checkbox":
?>
    <tr>
    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
        <td width="80%"><? if(get_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                </td>
    </tr>

    <tr>
        <td><small><?php echo $value['desc']; ?></small></td>
   </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px solid #E4E4E4;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php         break;

}
}
?>

<p class="submit">
<input name="save" type="submit" value="Save changes" />
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>

<?php
}

add_action('admin_menu', 'mytheme_add_admin');
remove_action('wp_head', 'wp_generator');
?>