<script type="text/javascript">
    (function ($) {
        var wfapp = {
            genShortCode : function () {
                var shortcode = [];
                //                for (x in wfalbum) {            
                //                    var pro = [
                //                        x, '="', wfalbum[x], '"'  
                //                    ];
                //                    shortcode.push(pro.join('')); 
                //                }
                //                return '[' + shortcode.join(" ") + ']';        
            },
    
            insert : function () {
        
            },
            
            move : function () {
                
            },
            
            init : function () {
                var $wfalbum_list = $('#wfalbum-list');
                $('li', $wfalbum_list).click(function () {
                    if ($(this).hasClass('selected')) {
                        $(this).removeClass('selected')
                    } else {
                        $(this).addClass('selected')
                    }
                })
            },
            
            fn : {}
        }    
    
        $(document).ready(function () {
            wfapp.init();
        })

    }    

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
            <select name="theme">
                <option>Galleria</option>
                <option>Nivo</option>
                <option>Coint</option>
            </select>
            <?php
            do_action('wfalbum_plugin_galleria');
            do_action('wfalbum_plugin_nivo');
            do_action('wfalbum_plugin_coint');
            ?>
            <div id="wfalbum_gallery_galleria">
                <input type="text" name="shortcode[width]" value="" />
                <input type="text" name="shortcode[height]" value="" />
            </div>

            <input type="button" class="button-primary" value="Insert Album" id="wfalbum-inserter"/>&nbsp;&nbsp;&nbsp;&nbsp;

        </div>

    </div>
</div>