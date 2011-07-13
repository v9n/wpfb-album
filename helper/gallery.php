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
     * Handle and parse shortcod!
     * This function parses shortcode, then load correct driver to parse shortcode
     */
    static public function shortcode() {
    }
    
    /**
     * Plugin can overwrite this funciton load addtional resources (script, style)! For example, each plugin has its own style and script..
     */
    public function bootstrap() { 
        
    }
    
}
