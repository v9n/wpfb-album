<?php
/*
 *  A venture of Axcoto http://axcoto.com
 *  by Vincent Nguyen <info@axcoto.com>
 */

class WfalbumHelperGalleryGalleria extends WfalbumHelperGallery implements iWfalbumHelperGallery {

    static public function info() {
        return array(
            'id' => 'galleria',
            'name' => 'jQuery Galleria'
        );
    }

    static function bootstrap() {
        wp_enqueue_script('galleria', self::url('gallery/galleria/galleria-1.2.4.min.js'), array('jquery'), '1.0.0', true);
        wp_enqueue_script('galleria-plugin', self::url('gallery/galleria/wf.galleria.js'), array('wfalbum-app-core'), '1.0.0', true);
    }

    /**
     * Render preference setting box for this plugin
     */
    static function preference() {
?>        
        <label>Width</label>
        <input type="text" name="width" value="" />
        <label>Heigh</label>
        <input type="text" name="height" value="" />
        <label>Counter</label>
        <input type="checkbox" name="autoplay" value="" />
        <label>Show image nav</label>
        <?php
    }

    public function render($photos, $atts=NULL) {
        static $i=0;
        $i++;
        $instance = 'wf_render_' . $i;
        ?>
        <div id="<?php echo $instance?>">
            <?php foreach ($photos['data'] as $photo) : ?>    
            <a href="#<?php //echo $photo['name'] ?>"><img title="<?php echo esc_attr(WfalbumHelperCore::g($photo['name'], '')); ?>" alt="<?php echo esc_attr(WfalbumHelperCore::g($photo['name'])); ?>&quote;" src="<?php echo $photo['images'][0]['source'] ?>"></a>
            <?php endforeach; ?>    
        </div>
        <script>
            (function ($) {
                $(document).ready(function () {
                    // Load the classic theme
                    Galleria.loadTheme('<?php echo Wfalbum::singleton()->url('helper/gallery/galleria/themes/classic/galleria.classic.min.js') ?>');

                    // Initialize Galleria
                    $('#<?php echo $instance?>').galleria({
                        height: 320
                    });
                })  
            })(jQuery);
        </script>
        <?php
    }

}