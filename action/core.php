<?php

/*
 * A project from Axcoto.Com
 * by kureikain
 */

class WfalbumActionCore {

    /**
     * Bootstrap function of Wfalbum!
     * This is to boot plugin! Execure all necessay action
     */
    public static function bootstrap() {
        ob_start();
    }

    /**
     * Admin Bootstrap for Wfalbum
     * This will be only fired on WordPress dashboard
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
     * Inject custom HTML of Wfalbum into footer of the site
     * to display Album selector form!
     * This render a place holder to list albums (those albums will be load
     * via Ajax), and control of Wfalbum, and preference panel!
     * Albums will be load via Ajax when the album selecting screen is show up,
     * but the loading task will be run only one time for speed! If users closed 
     * from, and open again, of course we don't need to reload via Ajax again!
     * @global Wfalbum $axcoto_Wfalbum
     * @see media_button
     */
    public static function admin_footer() {
        global $wpfb_album;
        global $post;
        global $wpdb;
        include $wpfb_album->pluginPath . 'templates/album/form.php';
    }
    
    /**
     * At this point, WordPress is shutting down and start to output content!
     * We call ob_end_flush to forece write out data which we prevent write out
     * because of ob_start()
     */
    public static function shutdown() {
        ob_end_flush();
    }

    /**
     * Action to load albuns via Ajax!
     * This method perform an executing of front/ controller to
     * load albums!
     * If an access token is valid, albums show up,
     * otherwise, Authorized form shows up
     * 
     */
    public static function load_albums() {
        Wfalbum::singleton()->handleBackendAction('wfalbum/front/load_albums');
        exit;
    }

}