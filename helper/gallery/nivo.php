<?php
/*
 *  A venture of Axcoto http://axcoto.com
 *  by Vincent Nguyen <info@axcoto.com>
 */

class WfalbumHelperGalleryNivo extends WfalbumHelperGallery implements iWfalbumHelperGallery {

    static public function info() {
        return array(
            'id' => 'nivo',
            'name' => 'Nivo Slider'
        );
    }

    static public function bootstrap() {
        wp_enqueue_style('nivo-theme', self::url('gallery/nivo/nivo-slider.css'));
        wp_enqueue_style('nivo-theme-default', self::url('gallery/nivo/themes/default/default.css'));
        wp_enqueue_style('nivo-theme-orman', self::url('gallery/nivo/themes/orman/orman.css'));
        wp_enqueue_style('nivo-theme-pascal', self::url('gallery/nivo/themes/pascal/pascal.css'));
        wp_enqueue_script('nivo', self::url('gallery/nivo/jquery.nivo.slider.pack.js"'), array('jquery'), '1.0.0', true);
        wp_enqueue_script('nivo-plugin', self::url('gallery/nivo/wf.nivo.js'), array('wfalbum-app-core'), '1.0.0', true);
    }

    /**
     * Render preference setting box for this plugin
     */
    static function preference() {
        ?>
        <div class="wf_pref_item"><?php self::field('text', 'Width', 'width'); ?></div>
        <div class="wf_pref_item"><?php self::field('text', 'height', 'height'); ?></div>
        <div class="wf_pref_item"><?php self::field('select', 'Theme', 'theme', array('theme-default' => 'Default', 'theme-pascal' => 'Pascal', 'theme-orman' => 'Orman', 'theme-orman' => 'Orman')); ?></div>
        <div class="wf_pref_item"><?php
        self::field('select', 'Effect', 'effect', array(
            'sliceDown', 'sliceDownLeft', 'sliceUp', 'sliceUpLeft', 'sliceUpDown', 'sliceUpDownLeft', 'fold', 'fade', 'random', 'slideInRight', 'slideInLeft', 'slideInLeft', 'boxRain', 'boxRandom', 'boxRain', 'boxRainReverse', 'boxRainGrow', 'boxRainGrowReverse'
        ));
        ?></div>
        <div class="wf_pref_item"><?php self::field('text', 'Slice', 'slice'); ?></div>
        <div class="wf_pref_item"><?php self::field('text', 'Box Columns', 'boxCols'); ?></div>
        <div class="wf_pref_item"><?php self::field('text', 'Box Rows', 'boxRows'); ?></div>
        <div class="wf_pref_item"><?php self::field('text', 'Slide transition speed', 'animSpeed'); ?></div>
        <div class="wf_pref_item"><?php self::field('text', 'How long each slide will show (in ms)', 'pauseTime'); ?></div>
        <div class="wf_pref_item"><?php self::field('checkbox', 'Hide Direction Nav', 'directionNav', false); ?></div>
        <div class="wf_pref_item"><?php self::field('checkbox', 'Hide Direction Nav on Hover', 'directionNavHide', false); ?></div>
        <div class="wf_pref_item"><?php self::field('checkbox', 'Hide Control Nav', 'controlNav', false); ?></div>
        <div class="wf_pref_item"><?php self::field('checkbox', 'Use Thumbnail for control nav', 'controlNavThumbs', true); ?></div>
        <div class="wf_pref_item"><?php self::field('checkbox', 'Not use Keyboard Nav', 'keyboardNav', false); ?></div>
        <div class="wf_pref_item"><?php self::field('checkbox', 'Not pause on when hovering', 'pauseOnHover', false); ?></div>
        <div class="wf_pref_item"><?php self::field('checkbox', 'Force Manual Transition', 'manualAdvance', true); ?></div>
        <div class="wf_pref_item"><?php self::field('text', 'Caption Opacity (0-1)', 'captionOpacity'); ?></div>
        <div class="wf_pref_item"><?php self::field('text', 'Previous Text', 'prevText'); ?></div>
        <div class="wf_pref_item"><?php self::field('text', 'Next Text', 'nextText'); ?></div>
        <?php
    }

    public function render($photos, $atts=NULL) {
        ob_start();
        self::$_insNum++;
        $instance = 'wf_render_' . self::$_insNum;
        $defaultAtts = array(
            'width' => 500,
            'height' => 400,
            'theme' => 'theme-default'
        );
        $atts = array_merge($defaultAtts, $atts);
        if (is_array($atts)) {
            $options = array();
            foreach ($atts as $optName => $optVal) {
                if ($optVal == 'false' || $optVal == 'true' || is_numeric($optVal)) {
                    $options[] = "$optName:$optVal";
                } else {
                    $options[] = "$optName:'$optVal'";
                }
            }
            $options = $options ? implode(", ", $options) : '';
        }
        ?>
        <style>
            #<?php echo $instance ?>_wrap {
                width: <?php echo $atts['width'] ?>px; /* Change this to your images width */
                height: <?php echo $atts['height'] ?>px; /* Change this to your images height */   
            }
        </style>
        <div class="slider-wrapper <?php echo $atts['theme'] ?>" id="<?php echo $instance ?>_wrap">
            <div class="ribbon"></div>

            <div id="<?php echo $instance ?>" class="nivoSlider">
                <?php foreach ($photos['data'] as $photo) : ?>    
                    <img title="<?php echo esc_attr(WfalbumHelperCore::g($photo['name'])); ?>" alt="<?php echo esc_attr(WfalbumHelperCore::g($photo['name'])); ?>" src="<?php echo $photo['images'][0]['source'] ?>" />
                <?php endforeach; ?>    
            </div>
        </div>
        <script>
            (function ($) {
                $(window).load(function () {
                    // Initialize Galleria
                    $('#<?php echo $instance ?>').nivoSlider({<?php echo $options ?>});
                })  
            })(jQuery);
        </script>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

}