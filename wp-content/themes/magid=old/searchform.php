<?php
/**
 * Default WordPress HTML5 Search Form
 *
 * @package Magid
 */

$search_query = filter_input( INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS );
?>

<label class="search__label">
    <span class="screen-reader-text"><?php _e( 'Search for:', 'magid' ) ?></span>
    <input type="search" class="search__field"
           placeholder="<?php _e( 'Search', 'magid' ) ?>"
           value="<?php echo $search_query; ?>" name="search"
           title="<?php _e( 'Search for:', 'magid' ) ?>"/>
</label>
<input type="submit" class="btn btn--primary btn--submit"
       value="<?php _e( 'Go', 'magid' ) ?>"/>