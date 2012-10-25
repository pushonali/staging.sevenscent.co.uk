<?php
if (in_category('gallery')) {include (TEMPLATEPATH . '/single_gallery.php');
}

else if (in_category('image')) {include (TEMPLATEPATH . '/single_image.php');
}

else if (in_category('media')) {include (TEMPLATEPATH . '/single_media.php');
}

else { include (TEMPLATEPATH . '/single_standard.php');
}
?>