<div id="wfalbum_form" style="display:none;">
    <div class="wfalbum_wrap">
        <div id="wfalbum_container">
            <div id="wfalbum_list">
                <?php
                foreach ($albums['data'] as $keys => $album) {
                    $photos = $fb->getPhotos($album['id']);
                    $album_cover = empty($photos['data'][0]['images'][3]) ? '' : $photos['data'][0]['images'][3]['source'];
                    ?>
                    <div class="wfalbum_item">
                        <a title="" href='#'><img src='<?php echo $album_cover ?>' border='0' alt="" title="" /></a>
                        <span><?php echo $album['name'] ?></span>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="clear"></div>
            <div class="wf-control">
                <a href="#" id="wfalbum-clear-cache">Clear Cache</a>
                &nbsp;&nbsp;&nbsp;
                <input type="button" class="button-primary wf-next" value="Next" />
            </div>

        </div>

        <div id="wfalbum_option">
            <select name="plugin" id="wf-plugin">
                <?php
                foreach (WfalbumHelperGallery::getPlugins() as $plugin) :
                    ?>
                    <option value="<?php echo $plugin['id'] ?>"><?php echo $plugin['name'] ?></option>
                    <?php
                endforeach
                ?>                    
            </select>

            <div id="wf_option_container">
            <?php
            //Display option panel
            foreach (WfalbumHelperGallery::getPlugins() as $plugin) :
                ?>
                <div id="wf_option_<?php echo $plugin['id'] ?>" class="wf_option_panel">
                    <?php do_action('wfalbum_plugin_' . $plugin['id']); ?>
                </div>
                <?php
            endforeach
            ?>
            </div>
            
            <div id="wfalbum_gallery_galleria">
                <input type="text" name="shortcode[width]" value="" />
                <input type="text" name="shortcode[height]" value="" />
            </div>

            <div class="wf-control">
                <input type="button" class="button-primary wf-back" value="Previous" />&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" class="button-primary" value="Insert Album" id="wf-inserter"/>&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
        </div>

    </div>
</div>