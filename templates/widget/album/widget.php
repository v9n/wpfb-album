<?php
/*
 *  A venture of Axcoto http://axcoto.com
 *  by Vincent Nguyen <info@axcoto.com>
 */
?>
<?php echo $before_widget; ?>
<?php $title && print ($before_title . $title . $after_title); ?>
<ul id="<?php echo $this->id ?>_wrap" class="wfalbum_widget">
    <?php
    $count = 0;
    if (is_array($photos['data'])) : foreach ($photos['data'] as $photo) :
            if ($count++ >= $instance['quantity']) {
                break;
            };
            ?>
            <li>
                <a style="width: <?php echo $instance['width']?>px; height: <?php echo $instance['height']?>px; " href="<?php echo $photo['images'][0]['source'] ?>" rel="<?php echo $this->id ?>">
                    <img src="<?php echo $photo['images'][3]['source'] ?>" />
                </a>
            </li>
            <?php
        endforeach;
    endif
    ?>
</ul>
<?php echo $after_widget; ?>
<script type="text/javascript">    
    //<![CDATA[
    (function ($) {
        $(document).ready(function () {
            $("a[rel='<?php echo $this->id ?>']").colorbox({slideshow:true <?php if ($instance['mode'] == 'fullscreen') : ?> , width: '100%', height: '100%' <?php endif ?> });
        })
    })(jQuery)

    //]]>
</script>