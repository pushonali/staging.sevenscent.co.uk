<?php
if (in_category('gallery')) {include (TEMPLATEPATH . '/category_image.php');
}

else if (in_category('media')) {include (TEMPLATEPATH . '/category_media.php');
}

else { include (TEMPLATEPATH . '/category_standard.php');
}
?>