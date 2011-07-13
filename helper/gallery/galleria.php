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

    public function render($photos) {
        ?>
        <div id="galleria">
            <?php foreach ($photos['data'] as $photo) : ?>    
                <a href="<?php echo $photo['name'] ?>"><img title="<?php echo $photo['name'] ?>" alt="<?php echo $photo['name'] ?>" src="<?php echo $photo['picture'] ?>"></a>
        <?php endforeach; ?>    
        </div>
        <style>#galleria{height:320px;}</style>
        <script>
            (function ($) {
                $(document).ready(function () {
                    // Load the classic theme
                    Galleria.loadTheme('<?php echo Wfalbum::singleton()->url('helper/gallery/galleria/themes/classic/galleria.classic.min.js') ?>');

                    // Initialize Galleria
                    $('#galleria').galleria();
                })  
            })(jQuery);
        </script>
        <?php
    }

    static function bootstrap() {
        
        wp_enqueue_script('galleria', self::url('gallery/galleria/galleria-1.2.4.min.js'), array('jquery'), '1.0.0', true);
    }

}