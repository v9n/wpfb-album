<?php

/*
 *  A venture of Axcoto http://axcoto.com
 *  by Vincent Nguyen <info@axcoto.com>
 */
class WfalbumHelperGallery {
    
    /**
     *
     * @global Wfalbum $wpfb_album
     * @param string $driver 
     */
    static public function factory($driver) {
        global $wpfb_album;
        if (file_exists($driver = $wpfb_album->pluginPath . '/helper/gallery/' . $driver . '.php')) {
            include_once $driver;
        }
        return new WfalbumHelperGallery . ucfirst($driver);
    }
    
    /**
     *
     * @global Wfalbum $wpfb_album 
     */
    protected function url($name) {
        global $wpfb_album;
        return $wpfb_album->pluginUrl . 'helper/' . $name;
    }
    
    /**
     * Handle and parse shortcod!
     * This function parses shortcode, then load correct driver to parse shortcode
     */
    static public function shortcode($atts, $content=null, $code="" ) {
        $album_id = WfalbumHelperCore::g($atts['id'], null);
        if ($album_id) {
            //Load photo of album then pass to driver
            
        }
    }
    
    /**
     * Plugin can overwrite this funciton load addtional resources (script, style)! For example, each plugin has its own style and script..
     */
    public function bootstrap() { 
        
    }
    
}
