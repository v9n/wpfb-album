<?php
/*
 *  A venture of Axcoto http://axcoto.com
 *  by Vincent Nguyen <info@axcoto.com>
 */
?>
<p>
    System cannot access your facebook photo! Maybe you have not authorized our application!
    This authorizing is to give this app permission to read your facebook photo!
    After authorized, you can come back this page to use plugin!
</p>
<br />
<p>
    <a class="button" href="<?php echo $fb->getAuthUrl() ?>">I am ok! Start to authorize</a>
</p>
