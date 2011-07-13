<?php

/*
 *  A venture of Axcoto http://axcoto.com
 *  by Vincent Nguyen <info@axcoto.com>
 */

class WfalbumHelpGalleryGalleria extends WfalbumHelperGallery implements iWfalbumHelperGallery{
    static public function info() {
        return array(
            'id' => 'Galleria',
            'name' => 'jQuery Galleria'
        );
    }
    
    public function render() {
        
    }
    
    public function bootstrap() {
        ;
    }
}