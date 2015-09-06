<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div>
        <input type="search" id="s" name="s" value="<?php _e('Search here...', 'selftitled'); ?>" onfocus="if (this.value == '<?php _e('Search here...', 'selftitled'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search here...', 'selftitled'); ?>';}" />
        <input type="submit"  name="submit" value="Search" id="searchsubmit" />
    </div>
</form>