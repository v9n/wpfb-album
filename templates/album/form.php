<div style="display: none">
    <div id="wfalbum_form">
        <div class="wfalbum_wrap">
            <div id="wfalbum_container">

                <div id="wfalbum_list_wrap">
                    <div id="wfalbum_list">
                        <img  src="<?php echo $wpfb_album->pluginUrl ?>assets/images/spin.gif" alt="Loading..." />
                    </div>
                </div>
                <div class="clear"></div>
                <div class="wf-control">
                    <a class="button" href="#" id="wf-clear-cache">Clear Cache</a>
                    &nbsp;&nbsp;&nbsp;
                    <a class="button wf-next">Next</a>
                </div>

            </div>

            <div id="wfalbum_option">
                <div class="wf-control">
                    <a class="button wf-back">Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;                    
                    <label>Choose a gallery/slider type, set preference, then insert</label>
                    <select name="plugin" id="wf-plugin">
                        <option value="0">Select Plugin</option>
                        <?php
                        foreach (WfalbumHelperGallery::getPlugins() as $plugin) :
                            ?>
                            <option value="<?php echo $plugin['id'] ?>"><?php echo $plugin['name'] ?></option>
                            <?php
                        endforeach
                        ?>                    
                    </select>
                    <a class="button" id="wf-inserter">Insert Album</a>
                </div>

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
            </div>

        </div>
    </div>
</div>