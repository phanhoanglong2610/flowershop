<label><?php _e('Select portfolio category', 'selftitled') ?></label>

    <?php $terms = get_terms('portfolio_taxonomy', 'hide_empty=0'); ?>
    <?php $mb->the_field('my_terms'); ?>
    <select name="<?php $mb->the_name(); ?>">
    <option value='All' <?php if (!count($terms)) echo "selected";?>>All</option>
    <?php foreach ($terms as $term): ?>
    <option value="<?php echo $term->name; ?>"<?php $mb->the_select_state($term->name); ?><?php echo '>' . $term->name; ?></option>
    <?php endforeach; ?>
    </select>
