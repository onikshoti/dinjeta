<?php

$unique_id = esc_attr(uniqid("search-form"));

?>
<form role="search" method="get" class="search-form"
action ="<?php echo esc_url(home_url('/'));?>">

<label class="screen-reader-text" for="<?php echo $unique_id ?>">
    <?php _e('search for:','your-textdomain') ?>
</label>

<input type="search" id="<?php echo $unique_id  ?>"
class="search-field"
placeholder="<?php ecs_attr_e("search...","your-textdomain")?>"
 value="<?php echo get_search_query(); ?>" name="s"/>

<input type="submit" 
class="search_submit" 
value="<?php esc_attr_e("search","your-textdomain") ?>">
</form>