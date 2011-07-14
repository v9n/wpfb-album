<script type="text/javascript">
    function insert_filebird_button(){
        product_id = jQuery("#filebird_product").val()
        image = jQuery("#filebird_button_image_url").val()

        construct = '<a href="<?php echo get_bloginfo('home'), '/', Wfalbum::singleton()->routerPrefix ?>/product/checkout/' + product_id + '"><img src="' + image + '" /></a>';

        var wdw = window.dialogArguments || opener || parent || top;
        wdw.send_to_editor(construct);
    }

    function insert_filebird_link(){
        product_id = jQuery("#filebird_product").val()

        construct = '<a href="<?php echo get_bloginfo('home'), '/', Wfalbum::singleton()->routerPrefix ?>/product/checkout/' + product_id + '"><?php echo get_option('siteurl') ?>/?checkout=' + product_id + '</a>';

        var wdw = window.dialogArguments || opener || parent || top;
        wdw.send_to_editor(construct);
    }
(function ($) {
    $(document).ready(function () {
        $wfalbum_list = $('#wfalbum-list');
        $('li', $wfalbum_list).click(function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected')
            } else {
                $(this).addClass('selected')
            }
        })
    })
})(jQuery)    
</script>

<div id="wfalbum_form" style="display:none;">
    <div class="wfalbum_wrap">
        <ul id="wfalbum-list">
            <?php
            foreach ($albums['data'] as $keys => $album) {
                $photos = $fb->getPhotos($album['id']);
                $album_cover = empty($photos['data'][0]['images'][3]) ? '' : $photos['data'][0]['images'][3]['source'];
                ?>
                <li>
                    <a title="" href='#'><img src='<?php echo $album_cover ?>' border='0' alt="" title="" /></a>
                    <span><?php echo $album['name']?></span>
                </li>
                <?php
            }
            ?>
        </ul>
        <select name="theme">
            <option>Galleria</option>
            <option>Nivo</option>
            <option>Coint</option>
        </select>
        <?php
        do_action('')
        ?>
        <div style="padding:15px;">
            <input type="button" class="button-primary" value="Insert Button" onclick="insert_filebird_button();"/>&nbsp;&nbsp;&nbsp;&nbsp;
        </div>

    </div>
</div>