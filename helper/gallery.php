<?php

/*
 *  A venture of Axcoto http://axcoto.com
 *  by Vincent Nguyen <info@axcoto.com>
 */

class WfalbumHelperGallery {

    static protected $_plugins = array();
    static protected $_drivers = array();
    static protected $_insNum = 0;

    /**
     * Load all gallery plugins!
     * Each gallery plugin must have a bootstrap method since they implement iWfalbumHelperGallery
     * Each gallery plugin must have a ::info method to be recognized and declare itself
     * Each gallery plugin should have a ::preference method to render preference box! Actually,
     * WfAlbum auto add an action with the name wfalbum_plugin_{plugin_id} to render its preference box
     * 
     * @global Wfalbum $wpfb_album
     * @param string $driver 
     */
    static public function init() {
        $dir = dirname(__FILE__) . '/gallery/';
        if ($handle = opendir($dir)) {
            /* This is the correct way to loop over the directory. */
            while (false !== ($file = readdir($handle))) {
                if (substr($file, -4) == '.php' && !is_dir($file)) {
                    include $dir . $file;

                    //Call bootstrap to load all plugin style& script
                    $classname = substr($file, 0, strlen($file) - 4);
                    $classname = 'WfalbumHelperGallery' . ucfirst($classname);
                    if (method_exists($classname, 'info')) {
                        //A plugin MUST HAVE ::info method to be recognized
                        $pluginInfo = $classname::info();
                        if (is_array($pluginInfo) && !empty($pluginInfo['id']) && empty(self::$_plugins[$pluginInfo['id']])) {
                            self::$_plugins[$pluginInfo['id']] = $pluginInfo;
                        }

                        method_exists($classname, 'bootstrap') && $classname::bootstrap();
                        method_exists($classname, 'preference') && add_action('wfalbum_plugin_' . $pluginInfo['id'], array($classname, 'preference'));
                    } else {
                        //@TODO Add warning or log message here
                        WfalbumHelperCore::log($classname . ' is missing ::info() method');
                    }
                }
            }
            closedir($handle);
        }
    }

    /**
     * Return all gallery plugin we had in system
     */
    static public function getPlugins() {
        return self::$_plugins;
    }

    /**
     *
     * @global Wfalbum $wpfb_album 
     */
    static protected function url($name) {
        return Wfalbum::singleton()->pluginUrl . 'helper/' . $name;
    }

    /**
     * Handle and parse shortcod!
     * This function parses shortcode, then load correct driver to parse shortcode
     */
    static public function shortcode($atts, $content=null, $code="") {
        global $wpfb_album;
        global $wpdb;

        WfalbumHelperCore::load('fb', false);
        $fb = new WfalbumHelperFb();

        $album_id = WfalbumHelperCore::g($atts['id'], null);
        $theme = WfalbumHelperCore::g($atts['theme'], 'galleria');

        $classname = 'WfalbumHelperGallery' . ucfirst($theme);
        if (!class_exists($classname)) {
            //fallback to default plugin
            $classname = 'WfalbumHelperGalleryGalleria';
            ;
        }
        if ($album_id) {
            //Load photo of album then pass to driver
            $photos = $fb->getPhotos($album_id);
            if ($photos['data']) {
                //Load corresponding driver for render
                if (empty(self::$_drivers[$theme])) {
                    self::$_drivers[$theme] = new $classname();
                }
                if (!empty($atts['pref'])) {
                    $_plugInOpts = explode(' ', $atts['pref']);
                    foreach ($_plugInOpts as $value) {
                        $value = explode('=', $value, 2);
                        $plugInOpts[$value[0]] = $value[1];
                    }
                } else {
                    $plugInOpts = array();
                }

                self::$_insNum++;
                ob_start();
                self::$_drivers[$theme]->render($photos, $plugInOpts);
                $html = ob_get_contents();
                ob_end_clean();
                return $html;
            }
        }
    }

    /**
     * Sanitize an option array into string!
     * Input like :
     * array(
     *  'boxCols' =>
     * )
     * @param array $option for ex: array(
     *      'boxCols' => 10,
     *      'efect' => 'random',
     *      ...
     *  )
     * @param array $maps a map of values to replace
     *          For example: 'effect' => 'This is an effect value'
     * and map can be:
     * array(
     *  'This is an effect value' => 'this is a replace value'
     * )
     * @return 
     *  *string like:
     *      'boxCols':10, 'effect':'random'
     *      If a value is boolean or numetic, the quote around it will be ommited!
     *  *NULL if invalid arguments or no option
     */
    static protected function _sanitizeOption($option, $maps=array()) {
        $sanitizeString = array();
        if (!is_array($option) || count($option) == 0) {
            return NULL;
        }
        foreach ($option as $optName => $optVal) {
            if ($optVal == 'false' || $optVal == 'true' || is_numeric($optVal)) {
                $sanitizeString[] = "$optName:$optVal";
            } else {
                $sanitizeString[] = "$optName:'$optVal'";
            }
        }
        return $sanitizeString ? implode(',', $sanitizeString) : '';
    }

    /**
     * Render label and element of a form field
     * @param string $type must be text, select, checkbox, radio
     * @param string $label of the field
     * @param string $name if the field
     * @param string or array If this is a textfield or checkbox, this can be anystring!
     *      But for select box, this will be an array in format
     *      array ( 
     *          option_value => option label,
     *          //...
     *      )
     *      an element of above array leads to an option <option value="optiob_value">Option label</option>
     * @param an array of attributes of field element such as class, id, alt, rel $attb 
     */
    static public function field($type, $label, $name, $value=NULL, $attb=array()) {
        !is_array($attb) && $attb = array();
        $defaultAttb = array(
            'id' => 'wf_pref_' . uniqid()
        );
        $attb = array_merge($defaultAttb, $attb);
        echo sprintf("<label for='%s'>%s</label>", $attb['id'], $label);
        switch ($type) {
            case 'text':
                echo sprintf("<input id='%s' type='text' name='%s' value='%s' %s />", $attb['id'], esc_attr($name), esc_attr($value), self::attributes($attb));
                break;
            case 'select':
                $html = sprintf("<select name='%s' id='%s'>", esc_attr($name), $attb['id']);
                if (is_array($value)) {
                    foreach ($value as $option => $txt) {
                        if (is_int($option)) {
                            $option = $txt;
                        }
                        $html .= sprintf("<option value='%s'>%s</option>", esc_attr($option), esc_attr($txt));
                    }
                }
                $html .= "</select>";
                echo $html;
                break;
            case 'checkbox':
                echo sprintf("<input id='%s' type='checkbox' name='%s' value='%s' %s />", $attb['id'], esc_attr($name), esc_attr($value), self::attributes($attb));
                break;
            case 'radio':
                if (is_array($value)) {
                    foreach ($value as $option => $txt) {
                        echo sprintf("<input type='radio' name='%s' value='%s' %s /><span>%s</span>", esc_attr($name), esc_attr($option), self::attributes($attb), $txt);
                    }
                }
                break;
        }
    }

    public static function attributes(array $attributes = NULL) {
        if (empty($attributes))
            return '';

        $compiled = '';
        foreach ($attributes as $key => $value) {
            if ($value === NULL) {
                // Skip attributes that have NULL values
                continue;
            }

            if (is_int($key)) {
                // Assume non-associative keys are mirrored attributes
                $key = $value;
            }

            // Add the attribute value
            $compiled .= ' ' . $key . '="' . esc_attr($value) . '"';
        }

        return $compiled;
    }

}

interface iWfalbumHelperGallery {

    /**
     * Plugin can overwrite this funciton load addtional resources (script, style)! For example, each plugin has its own style and script..
     */
    static function info();

    /**
     * Plugin can overwrite this funciton load addtional resources (script, style)! For example, each plugin has its own style and script..
     */
    static function bootstrap();

    /**
     * When users choose to use a plugin (theme in other word),
     * each plugin can have its own option so each plugin can implement this method to render
     * option box
     */
    static function preference();

    function render($photo, $atts=NULL);
}
