<?php

/*
 *  A venture of Axcoto http://axcoto.com
 *  by Vincent Nguyen <info@axcoto.com>
 */
?>
<?php echo $before_widget; ?>
<?php $title && print ($before_title . $title . $after_title); ?>

<ul>
    <?php
    if (is_array($groups)) : foreach ($groups as $post) :
    ?>
            <li><a href="<?php echo get_permalink($post->ID) ?>"><?php echo $post->post_title ?></a></li>
    <?php
            endforeach;
        endif
    ?>
    </ul>


<?php echo $after_widget; ?>