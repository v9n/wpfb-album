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
    <label for="<?php echo $this->get_field_id('quantity'); ?>"><?php _e('How many photos?'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('quantity'); ?>" name="<?php echo $this->get_field_name('quantity'); ?>" type="text" value="<?php echo $quantity; ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Thumbnail Size'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('quantity'); ?>" name="<?php echo $this->get_field_name('quantity'); ?>" type="text" value="<?php echo $quantity; ?>" />
    <input class="widefat" id="<?php echo $this->get_field_id('quantity'); ?>" name="<?php echo $this->get_field_name('quantity'); ?>" type="text" value="<?php echo $quantity; ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Display Type:'); ?></label>
    <select class="widefat" id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>" >
        <option <?php ($type == 'myactive') && print('selected="selected"'); ?>  value="myactive">Colorbox</option>
        <option <?php ($type == 'myactive') && print('selected="selected"'); ?>  value="myactive">Supersized!</option>
    </select>
</p>
