<div id="wfalbum_form" style="display:none;">
    <div class="wrap">
        <p>
            System cannot access your facebook photo! Maybe you have not authorized our application!
            This authorizing is to give this app permission to read your facebook photo!
            After authorized, you can come back this page to use this plugin!
            <br />
            <a class="button" target="_blank" onlick="jQuery.colorbox.close()
               " href="<?php echo $fb->getAuthUrl() ?>">I am ok! Start to authorize</a>
        </p>
    </div>
</div>