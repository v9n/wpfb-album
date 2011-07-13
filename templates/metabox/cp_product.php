<p>
    <label><?php echo __('Current Product')?>: <a href="<?php $file && print(FilebirdHelperCore::get_product_url($filebird_id))?>" target="_blank">Download</a></label>
    <input name="current_fb_file" type="text" value="<?php echo $file ?>" class="filebird-field-file side" />
    <br />
</p>

<p>
    <label><?php _e('Replace with') ?></label>
    <input name="filebird_file" type="file"  />
    <br />
    <label>Or enter new URL</label>
    <input name="filebird_url" type="text" value=" " class="filebird-field-file side" />

</p>

