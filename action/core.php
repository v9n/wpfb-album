<?php

/*
 * A project from Axcoto.Com
 * by kureikain
 */

class WfalbumActionCore {

    /**
     * Bootstrap of Wfalbum
     */
    public static function bootstrap() {
        ob_start();
    }

    /**
     * Admin Bootstrap for Wfalbum
     */
    public static function bootstrap_admin() {
        
    }

    /**
     * Add Wfalbum button to media buttons
     * @global Wfalbum $axcoto_Wfalbum
     * @param string $context HTML of media button
     * @return string HTMl of media button with added Wfalbum button
     */
    public static function media_button($context) {
        global $wpfb_album;
        global $page;
        $image_url = $wpfb_album->pluginUrl . '/assets/images/media-button.png';
        $more = '<a id="media_wf_album" href="#" title="Insert Facebook Album"><img src="' . $image_url . '" alt="Insert Facebook Album" /></a>';
        return $context . $more;
    }

    /**
     * Display custom metabox for our post type
     * @global stdClass  $post
     */
    public static function meta_options() {
        global $post;
        $custom = get_post_custom($post->ID);
        $price = $custom["_fb_price"][0];
        $file = $custom["_fb_file"][0];
        $html = include Wfalbum::singleton()->pluginPath . '/templates/metabox/product.php';
    }

    /**
     * Display custom Wfalbum metabox for ad_listing of CLASSIPRESS
     * @global <type> $post
     */
    public static function meta_cp_options() {
        global $post;
        $Wfalbum_id = get_post_meta($post->ID, '_fb_id', true);
        $custom = get_post_custom($Wfalbum_id);
        $file = empty($custom['_fb_file'][0]) ? '' : $custom['_fb_file'][0];
        $html = include Wfalbum::singleton()->pluginPath . '/templates/metabox/cp_product.php';
    }

    /**
     * Enable uploading when editting posts
     */
    public static function post_edit_form_tag() {
        global $post;
        echo ' enctype="multipart/form-data"';
    }

    /**
     * Alter admin footer for custom html code of Wfalbum or for some related task
     * @global Wfalbum $axcoto_Wfalbum
     * @see media_button
     */
    public static function footer() {
        global $wpfb_album;
        global $post;
        global $wpdb;
        $fb = WfalbumHelperCore::load('fb', true);
        $albums = $fb->getAlbums();
        $count = 0;
        include $wpfb_album->pluginPath . 'templates/album/form.php';
    }

    public static function shutdown() {
        ob_end_flush();
    }

    /**
     * Action to load albuns via Ajax!
     * Actually, this method will execute a controller request
     */
    public static function load_albums() {
        Wfalbum::singleton()->handleBackendAction('wfalbum/front/load_albums');
        exit;
    }

}