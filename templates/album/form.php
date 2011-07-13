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

        construct = '<a href="<?php echo get_bloginfo('home'), '/',Wfalbum::singleton()->routerPrefix ?>/product/checkout/' + product_id + '"><?php echo get_option('siteurl') ?>/?checkout=' + product_id + '</a>';

        var wdw = window.dialogArguments || opener || parent || top;
        wdw.send_to_editor(construct);
    }
</script>

<div id="wfalbum_form" style="display:none;">
    <div class="wrap">
        <div>
            <div style="padding:15px 15px 0 15px;">
                <h3>File Bird<br />Insert Checkout Button/Link</h3>
                <span>Choose one of your products below to insert a download link to your page or post.</span>
            </div>
            <div style="padding:15px 15px 0 15px;">
                <table width="100%">
                    <tr>
                        <td width="160"><strong>Product</strong></td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <td width="160"><strong>Button Image URL:</strong></td>
                        <td>
                            <input type="text" id="filebird_button_image_url" value="https://www.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" style="width:400px;" />
                        </td>
                    </tr>
                </table>
            </div>

            <div style="padding:15px;">
                <input type="button" class="button-primary" value="Insert Button" onclick="insert_filebird_button();"/>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" class="button" value="Insert Link Only" onclick="insert_filebird_link();"/>&nbsp;&nbsp;&nbsp;&nbsp;<a style="font-size:0.9em;text-decoration:none;color:#555555;" href="#" onclick="tb_remove(); return false;">Cancel and Close</a>
            </div>
        </div>
    </div>
</div>