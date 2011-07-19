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
    if (is_array($photos['data'])) : foreach ($photos['data'] as $photo) :
            ?>
            <li>
                <a href="<?php echo $photo['images'][0]['source'] ?>" rel="<?php echo $this->id ?>">
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
<?php
switch ($instance['mode']) :
    case 'supersized':
        ?>
                                            
        <?php
        break;
    case 'colorbox':
    default:
        ?>
                            $("a[rel='<?php echo $this->id ?>']").colorbox({slideshow:true});
        <?php
        break;
endswitch;
?>
        })
    })(jQuery)
    //]]>
</script>