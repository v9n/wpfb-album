<div id="wf_auth_box">
    <p>
        System cannot access your facebook photo! Maybe you have not authorized our application!
        This authorizing is to give this app permission to read your facebook photo!
        After authorized, you can come back this page to use this plugin!
    </p>
    <br />
    <p>
        <a class="button" target="_blank" href="javascript:window.open('<?php echo $fb->getAuthUrl() ?>')">I am ok! Start to authorize</a>
    </p>
</div>