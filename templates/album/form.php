<script type="text/javascript">
    (function ($) {

    }) (jQuery)    

</script>

<div id="wfalbum_form" style="display:none;">
    <div class="wfalbum_wrap">
        <div id="wfalbum_container">
            <ul id="wfalbum-list">
                <?php
                foreach ($albums['data'] as $keys => $album) {
                    $photos = $fb->getPhotos($album['id']);
                    $album_cover = empty($photos['data'][0]['images'][3]) ? '' : $photos['data'][0]['images'][3]['source'];
                    ?>
                    <li>
                        <a title="" href='#'><img src='<?php echo $album_cover ?>' border='0' alt="" title="" /></a>
                        <span><?php echo $album['name'] ?></span>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <div class="clear"></div>
            <a href="#" id="wfalbum-clear-cache">Clear Cache</a>
            <input type="button" class="button-primary" value="Next" id=""/>
        </div>

        <div class="" id="wfalbum-option">
            <select name="plugin">
                <?php
                foreach (WfalbumHelperGallery::getPlugins() as $plugin) :
                    ?>
                    <option value="<?php echo $plugin['id'] ?>"><?php echo $plugin['name'] ?></option>
                    <?php
                endforeach
                ?>                    
            </select>

            <?php
            //Display option panel
            foreach (WfalbumHelperGallery::getPlugins() as $plugin) :
                ?>
            <div id="wf_option_<?php echo $plugin['id']?>" class="wf_option_panel">
                <?php do_action('wfalbum_plugin_' . $plugin['id']);?>
            </div>
                <?php
            endforeach
            ?>

            <div id="wfalbum_gallery_galleria">
                <input type="text" name="shortcode[width]" value="" />
                <input type="text" name="shortcode[height]" value="" />
            </div>

            <input type="button" class="button-primary" value="Insert Album" id="wfalbum-inserter"/>&nbsp;&nbsp;&nbsp;&nbsp;

        </div>

    </div>
</div>