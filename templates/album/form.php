<div id="wfalbum_form">
    <div class="wfalbum_wrap">
        <div id="wfalbum_container">
            <div id="wfalbum_list">
                <img  src="<?php echo $wpfb_album->pluginUrl?>assets/images/spin.gif" alt="Loading..." />
            </div>
            <div class="clear"></div>
            <div class="wf-control">
                <a class="button" href="#" id="wf-clear-cache">Clear Cache</a>
                &nbsp;&nbsp;&nbsp;
                <a class="button-primary wf-next">Next</a>
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