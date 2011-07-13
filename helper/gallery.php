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
    
    public function shortcode() {
        
    }
}

interface iWfalbumHelperGallery {
    /**
     * Each gallery plugin must implement this function to render html content
     */
    public function render();
    
    /**
     * Each gallery plugin must implement this function to add custom css, javascript
     */
    public function bootstrap();
}