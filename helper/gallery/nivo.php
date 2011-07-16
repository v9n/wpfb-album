<?php
/*
 *  A venture of Axcoto http://axcoto.com
 *  by Vincent Nguyen <info@axcoto.com>
 */

class WfalbumHelperGalleryNivo extends WfalbumHelperGallery {

    static public function info() {
        return array(
            'id' => 'nivo',
            'name' => 'Nivo Slider'
        );
    }

    public function render() {
        
    }

    static public function bootstrap() {
        ;
    }

    /**
     * Render preference setting box for this plugin
     */
    static function preference() {
        ?>        
        <input type="text" name="height" value="" />
        <label>Auto Play</label>
        <input type="checkbox" name="autoplay" value="" />
        <label>Show image nav</label>
        <?php
    }

}