<?php $metabox->the_field('dynamic_sidebar'); ?>

<select name="<?php $mb->the_name(); ?>">
<?php foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { ?>
     <option value="<?php echo $sidebar['id']; ?>" <?php $mb->the_select_state($sidebar['id']); ?>>
              <?php echo  $sidebar['name']; ?>
     </option>
<?php } ?>
</select>