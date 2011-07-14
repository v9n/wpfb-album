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
</script>

<div id="wfalbum_form" style="display:none;">
    <div class="wrap">
        <?php
        foreach ($albums['data'] as $keys => $album) {
            $photos = $fb->getPhotos($album['id']);
            $album_cover = empty($photos['data'][0]['images'][3]) ? '' : $photos['data'][0]['images'][3]['source'];
            ?>
            <div style='padding: 10px; width: 150px; height: 170px; float: left;'>
                <a href='admin.php?page=wfalbum&uri=wfalbum/front/album/" . $album['id'] . "'>
                   <img src='<?php echo $album_cover ?>' border='1' />
                </a>
            </div>
            <?php
        }
        ?>
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