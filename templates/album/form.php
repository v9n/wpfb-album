<div id="wfalbum_form">
    <div class="wfalbum_wrap">
        <div id="wfalbum_container">
            <div id="wfalbum_list">
                <?php
                foreach ($albums['data'] as $keys => $album) {
//                    $photos = $fb->getPhotos($album['id']);
//                    $album_cover = empty($photos['data'][0]['images'][1]) ? '' : $photos['data'][0]['images'][1]['source'];
                    $album_cover = $fb->getPhoto($album['cover_photo']);
                    foreach ($album_cover['images'] as $image) {
                        if ($image['width']==180) {
                            $album_cover = $image;
                            break;
                        }
                    }
                    ?>
                    <div class="wfalbum_item" id="wfalbum_item_<?php echo $album['id'] ?>" rel="<?php echo $album['id'] ?>">
                        <a title="" href='#'><img src='<?php echo $album_cover['source'] ?>' border='0' alt="" title="" /></a>
                        <span><?php echo $album['name'] ?> // <?php echo $album['count']?> photos</span>
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
            <label>Choose A Gallery/Slider:</label>
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
                        <form id="wf_prep_form_<?php echo $plugin['id'] ?>">
                            <?php do_action('wfalbum_plugin_' . $plugin['id']); ?>
                        </form>
                    </div>
                    <?php
                endforeach
                ?>
            </div>

            <div class="wf-control">
                <input type="button" class="button-primary wf-back" value="Previous" />&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" class="button-primary" value="Insert Album" id="wf-inserter"/>&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
        </div>

    </div>
</div>