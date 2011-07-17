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
        self::field('text', 'Width', 'width');
        self::field('text', 'Height', 'height');
        ?>      

        <div class="wf_pref_item">
            <label>Autoplay (milliseconds)</label>
            <input type="text" name="autoplay" value="" /
        </div>
        <div class="wf_pref_item"
             <label>Carousel Speed (in milliseconds)</label>
            <input type="checkbox" name="carousel" value="" />
        </div>
        <div class="wf_pref_item">
            <?php self::field('select', 'Easing', 'easing', array(0 => 'default', 'galleria' => 'Galleria', 'galleriaIn' => 'Galleria In', 'galleriaOut' => 'Galleria Out')); ?>
        </div>
        <div class="wf_pref_item">
            <?php self::field('select', 'Image Crop', 'imageCrop', array(0 => 'default', 'true', 'height', 'width')); ?>
        </div>
        <div class="wf_pref_item">
            <?php self::field('text', 'Image Margin', 'imageMargin'); ?>
        </div>
        <div class="wf_pref_item">
            <?php self::field('checkbox', 'Image Pan', 'imagePan', 'true'); ?>
        </div>
        <div class="wf_pref_item">
            <?php self::field('checkbox', 'Lightbox', 'lightbox', 'true'); ?>
        </div>
        <div class="wf_pref_item">
        </div>
        <?php self::field('text', 'Lightbox Fade Speep (in milliseconds)', 'lightboxFadeSpeed'); ?>
        </div>        
        <div class="wf_pref_item">
            <?php self::field('text', 'Overlay Opacity', 'overlayOpacity'); ?>
        </div>
        <div class="wf_pref_item">
            <?php self::field('checkbox', 'Hide Capion', 'showInfo', 'false'); ?>
        </div>
        <div class="wf_pref_item">
            <?php self::field('checkbox', 'Hide Counter', 'showCounter', 'false'); ?>
        </div>
        <div class="wf_pref_item">
            <?php self::field('checkbox', 'Hide Arrow Navigation', 'showImagenav', 'false'); ?>
        </div>
        <div class="wf_pref_item">
            <?php self::field('select', 'Transition Effect', 'transition', array(0 => 'fade', 'flash', 'pulse', 'slide', 'fadeslide')); ?>
        </div>
        <div class="wf_pref_item">
            <?php self::field('text', 'Transition Speed (in milliseconds), The higher number, the slower transition.', 'transitionSpeed'); ?>
        </div>
        <div class="wf_pref_item">
            <label>Counter</label>
            <input type="checkbox" name="autoplay" value="" />
        </div>

        <?php
    }

    public function render($photos, $atts=NULL) {
        static $i = 0;
        $i++;
        $instance = 'wf_render_' . $i;
        ?>
        <div id="<?php echo $instance ?>">
            <?php foreach ($photos['data'] as $photo) : ?>    
                <a href="#<?php //echo $photo['name']       ?>"><img title="<?php echo esc_attr(WfalbumHelperCore::g($photo['name'], '')); ?>" alt="<?php echo esc_attr(WfalbumHelperCore::g($photo['name'])); ?>&quote;" src="<?php echo $photo['images'][0]['source'] ?>"></a>
            <?php endforeach; ?>    
        </div>
        <script>
            (function ($) {
                $(document).ready(function () {
                    // Load the classic theme
                    Galleria.loadTheme('<?php echo Wfalbum::singleton()->url('helper/gallery/galleria/themes/classic/galleria.classic.min.js') ?>');

                    // Initialize Galleria
                    $('#<?php echo $instance ?>').galleria({
                        height: 320
                    });
                })  
            })(jQuery);
        </script>
        <?php
    }

}