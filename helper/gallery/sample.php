<?php

/*
 *  A venture of Axcoto http://axcoto.com
 *  by Vincent Nguyen <info@axcoto.com>
 */

class WfalbumHelperGallerySample extends WfalbumHelperGallery {
    static public function info() {
        return array(
            //THIS IS A SAMPLE PLUGIN. SO I DID"T PUT ITS ID HERE! THIS LEADS TO IT WILL NOT APPEAR
            //'id' => 'sample', //Should be in low-case without any special character, and unique too! So, be catefully when choosing a id
            'name' => 'Sample' //Any text to identify or name your plugin
        );
    }
    
    static public function bootstrap() {
        //Should load extra css, script? Put it here
        //wp_enqueu_style
        //wp_enqueu_script
        ;
    }
    
    
    public function render() {
        
    }
    
    
}