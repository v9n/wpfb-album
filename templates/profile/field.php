<table class="form-table">
    <tr>
        <th><label for="fb_paypal"><?php echo __('Seller PayPal Email') ?>:</label></th>
        <td>
            <input type="text" name="fb_paypal" id="fb_paypal" value="<?php echo esc_attr(get_the_author_meta('fb_paypal', $user->ID)); ?>" class="regular-text" /><br />
            <span class="description"><?php echo __('This is paypal email which money will be sent to when someone bought your product') ?>.</span>
            <br />
            <?php if (!current_user_can('sell_file')) :
               
                ?>
            <a href="<?php echo get_bloginfo('url') ?>/filebird/membership/buy">Buy Membership ($<?php echo $option['download_membership_cost']?>)</a>
            <?php else : ?>
                You had membership for inserting file
            <?php endif ?>
            
        </td>
    </tr>
</table>
