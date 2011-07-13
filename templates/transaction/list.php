<div class="wrap">
    <div class="icon32 icon32-posts-certcogroup" id="icon-edit"><br></div>
    <h2>Number of sales: <?php echo $transactions['total']['transaction']?></h2>
    <h3>You earned: $<?php echo empty($transactions['total']['money'])? 0:$transactions['total']['money']?></h3>
    <table cellspacing="0" class="wp-list-table widefat fixed posts">
        <thead>
            <tr>
                <th style="" class="manage-column column-title sortable desc" id="title" scope="col">
                    <a href=""><span>File</span></a>
                </th>
                <th style="" class="manage-column column-date sortable asc" id="date" scope="col">
                        <span>Paid Amount</span>
                </th>
                <th style="" class="manage-column column-date sortable asc" id="date" scope="col">
                        <span>Payer</span>
                </th>
                <th style="" class="manage-column column-date sortable asc" id="date" scope="col">
                        <span>Date</span>
                </th>
            </tr>
        </thead>


        <tbody id="the-list">
            <?php
            if (!empty($transactions['total']['transaction'])) :
                foreach ($transactions['list'] as $item) :
            ?>
                    <tr valign="top" class="alternate author-other status-publish format-default iedit" id="post-19">
                        <td class="post-title page-title column-title">
                            <strong><a title="#" href="post.php?action=edit&post=<?php echo $item['product_id']?>" class="row-title"><?php echo $item['post_title']?></a></strong>
                        </td>
                        <td>$<?php echo $item['mc_gross']?></td>
                        <td><?php echo $item['payer_email']?></td>
                        <td><?php echo $item['created_at']?></td>
                    </tr>
            <?php
                    endforeach;
                endif;
            ?>
        </tbody>
    </table>
</div>