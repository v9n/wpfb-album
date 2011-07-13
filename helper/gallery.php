<?php

/*
 *  A venture of Axcoto http://axcoto.com
 *  by Vincent Nguyen <info@axcoto.com>
 */

class WfalbumHelperGallery {

    static protected $_drivers = array();

    /**
     * Load all gallery plugins
     * @global Wfalbum $wpfb_album
     * @param string $driver 
     */
    static public function init() {       
        $dir = dirname(__FILE__) . '/gallery/';
        if ($handle = opendir($dir)) {
            /* This is the correct way to loop over the directory. */
            while (false !== ($file = readdir($handle))) {
                if (substr($file, -4) == '.php' && !is_dir($file)) {
                    include $dir . $file;           
                }
            }
            closedir($handle);
        }
    }

    /**
     *
     * @global Wfalbum $wpfb_album 
     */
    static protected function url($name) {
        global $wpfb_album;
        return $wpfb_album->pluginUrl . 'helper/' . $name;
    }

    /**
     * Handle and parse shortcod!
     * This function parses shortcode, then load correct driver to parse shortcode
     */
    static public function shortcode($atts, $content=null, $code="") {
        global $wpfb_album;
        global $wpdb;

        WfalbumHelperCore::load('fb', false);
        $fb = new WfalbumHelperFb();

        $album_id = WfalbumHelperCore::g($atts['id'], null);
        $theme = WfalbumHelperCore::g($atts['theme'], 'galleria');

        if ($album_id) {
            //Load photo of album then pass to driver
            $photos = $fb->getPhotos($album_id);
            if ($photos['data']) {
                //Load corresponding driver for render
                if (empty(self::$_drivers[$theme])) {
                    self::$_drivers[$theme] = new WfalbumHelpGalleryGalleria();
                }
                return self::$_drivers[$theme]->render($photos);
            }
        }
    }

    /**
     * Plugin can overwrite this funciton load addtional resources (script, style)! For example, each plugin has its own style and script..
     */
    public function bootstrap() {
        
    }

}
