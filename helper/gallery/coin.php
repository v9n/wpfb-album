<?php
/*
 *  A venture of Axcoto http://axcoto.com
 *  by Vincent Nguyen <info@axcoto.com>
 */

class WfalbumHelperGalleryCoin extends WfalbumHelperGallery {

    static public function info() {
        return array(
            'id' => 'coin',
            'name' => 'Coin Slider'
        );
    }

    static public function bootstrap() {
        wp_enqueue_style('coin-theme', self::url('gallery/coin/coin-slider-styles.css'));
        wp_enqueue_script('coint', self::url('gallery/coin/coin-slider.min.js"'), array('jquery'), '1.0.0', true);
        wp_enqueue_script('coint-plugin', self::url('gallery/coin/wf.coin.js'), array('wfalbum-app-core'), '1.0.0', true);
    }

    /**
     * Render preference setting box for this plugin
     */
    static function preference() {
        ?>        
        <div class="wf_pref_item"><?php self::field('text', 'Width', 'width'); ?></div>
        <div class="wf_pref_item"><?php self::field('text', 'height', 'height'); ?></div>
        <div class="wf_pref_item"><?php
        self::field('select', 'Effect', 'effect', array(
            'random', 'swirl', 'raind', 'straight'
        ));
        ?></div>
        <div class="wf_pref_item"><?php self::field('text', 'squares per width', 'spw'); ?></div>
        <div class="wf_pref_item"><?php self::field('text', 'squares per height', 'sph'); ?></div>
        <div class="wf_pref_item"><?php self::field('text', 'delay between images in ms', 'delay'); ?></div>
        <div class="wf_pref_item"><?php self::field('text', 'delay beetwen squares in ms', 'sDelay'); ?></div>
        <div class="wf_pref_item"><?php self::field('text', 'Opacity of Caption and Title', 'opacity'); ?></div>
        <div class="wf_pref_item"><?php self::field('text', 'Title Speed', 'titleSpeed'); ?></div>
        <div class="wf_pref_item"><?php self::field('checkbox', 'Hide Navigation', 'navigation', false); ?></div>
        <div class="wf_pref_item"><?php self::field('checkbox', 'Hide Links', 'links', false); ?></div>
        <div class="wf_pref_item"><?php self::field('checkbox', 'Not pause on when hovering', 'hoverPause', false); ?></div>
        <?php
    }

    public function render($photos, $atts=NULL) {
        $instance = 'wf_render_' . self::$_insNum;
        $defaultAtts = array(
            'width' => 500,
            'height' => 400,
            'effect' => 'random'
        );
        $atts = array_merge($defaultAtts, $atts);
        $options = self::_sanitizeOption($atts);
        ?>
        <div id="<?php echo $instance ?>" class="nivoSlider">
            <?php foreach ($photos['data'] as $photo) : ?>   
                <a href="<?php echo $photo['images'][0]['source'] ?>" target="_blank">
                    <img alt="<?php echo esc_attr(WfalbumHelperCore::g($photo['name'])); ?>" src="<?php echo $photo['images'][0]['source'] ?>" />
                    <span><?php echo esc_attr(WfalbumHelperCore::g($photo['name'])); ?></span>
                </a>
            <?php endforeach; ?>    
        </div>

        <script>
            (function ($) {
                $(window).load(function () {
                    // Initialize Galleria
                    $('#<?php echo $instance ?>').coinslider({<?php echo $options ?>});
                })  
            })(jQuery);
        </script>
        <?php
    }

}