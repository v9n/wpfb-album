<div id="wrap" class="wrap redirect">
    <h2><?php echo $title?></h2>
    <p class="message"><?php echo $message?></p>
    <script>
        window.location = '<?php echo AxcotoFontBird::singleton()->uri($page, $url)?>';
    </script>
    <p>
        <img src="<?php echo AxcotoFontBird::singleton()->pluginUrl?>assets/images/loader.gif" alt="waiting.."/><br />
        Browser is redirecting you! Wait a moment
    </p>
</div>