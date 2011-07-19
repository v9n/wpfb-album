<?php
/*
 *  A venture of Axcoto http://axcoto.com
 *  by Vincent Nguyen <info@axcoto.com>
 */
?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Choose Album:'); ?></label>
    <select class="widefat" id="<?php echo $this->get_field_id('album_id'); ?>" name="<?php echo $this->get_field_name('album_id'); ?>">
        <?php foreach ($albums['data'] as $album) : ?>
        <option value="<?php echo $album['id'] ?>" <?php $album['id']==$album_id && print('selected="selected"')?>  ><?php echo $album['name'] ?></option>         
            <?php
        endforeach;
        ?>
    </select>
</p>

<p>
    <label for="<?php echo $this->get_field_id('quantity'); ?>"><?php _e('How many photos to display?');
        ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('quantity'); ?>" name="<?php echo $this->get_field_name('quantity'); ?>" type="text" value="<?php echo $quantity; ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Thumbnail Sizes: (<75px)'); ?>:</label>
    <br />
    Width:<input class="widefat medium" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" />
    Height:<input class="widefat medium" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id('mode'); ?>"><?php _e('Display Type:'); ?></label>
    <select class="widefat" id="<?php echo $this->get_field_id('mode'); ?>" name="<?php echo $this->get_field_name('mode'); ?>" >
        <option <?php ($mode == 'normal') && print('selected="selected"'); ?>  value="normal">Normal</option>
        <option <?php ($mode == 'fullscreen') && print('selected="selected"'); ?>  value="fullscreen">Full Screen</option>
    </select>
</p>
