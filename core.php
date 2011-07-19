<?php

/**
  Plugin Name: WB Facebook Album
  Plugin URI: http://axcoto.com/
  Description: Display your facebook album into WordPress
  Version: 1.0
  Author: kureikain <info@axcoto.com>
  Author URI: http://axcoto.com/
 */
include 'option/core.php';
include 'action/core.php';
include 'filter/core.php';
include 'widget/core.php';
include 'model/core.php';
include 'helper/core.php';
include 'helper/cache.php';

class Wfalbum {

    /**
     * Construct Wfalbum plugin, set pluginName, pluginUrl, pluginPath
     */
    public function __construct() {
        $this->pluginName = dirname(plugin_basename(__FILE__));
        $this->pluginUrl = WP_PLUGIN_URL . "/$this->pluginName/";
        $this->pluginPath = WP_PLUGIN_DIR . "/$this->pluginName/";
    }

    /**
     * Init cache class!
     * Load all styles, script, define JavaScript var with useful URL
     */
    public function init() {
        Axche::init(array('dir' => $this->pluginPath . 'cache/', 'exp' => 3000));

        if (count($this->styles)) {
            foreach ($this->styles as $name => $style) {
                wp_register_style($name, $this->pluginUrl . $style[0], $style[1], $style[2], $style[3]);
                if ($style[4] == 'auto' || ($style[4] == 'admin' && is_admin()) || $style[4] == 'frontend') {
                    wp_enqueue_style($name);
                }
            }
        }
        if (count($this->scripts)) {
            foreach ($this->scripts as $name => $script) {
                wp_register_script($name, $this->pluginUrl . $script[0], $script[1], $script[2], $script[3]);
                if ($script[4] == 'auto' || ($script[4] == 'admin' && is_admin()) || $script[4] == 'frontend') {
                    wp_enqueue_script($name);
                }
            }
        }
        /**
         * Actually, this function is used to localize javascript language! Imagine, we have our strings in normal PHP which
         * we can translate easily use __() translate function! But how about JavaScript, we cannot use __() because string is in a JavaScript file!
         * Fortunately, WordPress gives us wp_localize_script to handle l10n for JS file!
         * And we take advantage of this to output an URL point to admin-ajax.php to prepare for out request
         * and to output some of cool JavaScript varrible! 
         * 
         */
        wp_localize_script('wfalbum-app-core', 'wfalbum', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'url' => get_bloginfo('url'),
            'pluginUrl' => $this->pluginUrl
        ));

        /**
         * Handle shortcode! 
         * WfAlbumHelperGallery parse shortocode, gather data for album,
         * then call corresponding gallery plugin to output content
         */
        WfalbumHelperCore::load('gallery', false);
        WfalbumHelperGallery::init();
        add_shortcode('wfalbum', array('WfalbumHelperGallery', 'shortcode'));


        register_activation_hook(__FILE__, array(&$this, 'active'));
        register_deactivation_hook(__FILE__, array(&$this, 'deactive'));

        add_filter('query_vars', array('WfalbumFilterCore', 'query_vars'));

        add_action('widgets_init', array('WfalbumWidgetCore', 'init'));
        add_action('admin_menu', array(&$this, 'menu'));

        add_action('init', array('WfalbumActionCore', 'bootstrap'));
        add_action('admin_init', array('WfalbumActionCore', 'bootstrap_admin'));
        add_action('admin_init', array('WfalbumOptionCore', 'init'));


        add_action('wp_footer', array('WfalbumActionCore', 'shutdown'), PHP_INT_MAX);
        add_action('admin_footer', array('WfalbumActionCore', 'admin_footer'), PHP_INT_MAX);
        add_action('get_header', array($this, 'handleFrontendAction'));

        add_action('media_buttons_context', array('WfalbumActionCore', 'media_button'));

        add_action('wp_ajax_wf_load_albums', array('WfalbumActionCore', 'load_albums'));
    }

    /**
     * Main method to router and execute request in wordpress back-end!
     * It router request, dispatch, load controller then return responding
     *
     * @see handleBackendAction
     */
    public function execute($uri='', $dir='admin/') {
        //echo 'lol', get_query_var('axcotouri'), 'lol';
        $this->router = array();
        $this->router['controller'] = 'front';
        $this->router['method'] = 'index';
        $this->router['segment'] = $uri;

        $part = explode('/', $this->router['segment']);
        $segmentCount = count($part);

        $this->router['controller'] = $part[0];
        array_shift($part);
        $this->router['method'] = (count($part) >= 1) ? $part[0] : 'index';
        array_shift($part);
        $param = $part;


        if (!file_exists($this->pluginPath . '/controller/' . $dir . $this->router['controller'] . '.php')) {
            $this->router['controller'] = 'front';
        }
        include $this->pluginPath . 'controller/' . $dir . $this->router['controller'] . '.php';
        $className = 'Wfalbum' . ucfirst($this->router['controller']) . 'Controller';

        $this->responser = new $className;
        if (!method_exists($this->responser, 'action_' . $this->router['method'])) {
            $param = array_merge(array($this->router['method']), $param);
            $this->router['method'] = 'index';
        }
        return call_user_func_array(array(&$this->responser, 'action_' . $this->router['method']), $param);
    }

    /**
     * This is main  entry point for all request come to WordPress backend! It then call execute() to execure requesr
     */
    public function handleBackendAction($uri='', $echo=true) {
        if (!$uri) {
            $uri = empty($_GET['uri']) ? (empty($_GET['page']) ? 'front' : $_GET['page']) : $_GET['uri'];
        }
        
        $part = explode('/', $uri, 2);
        if ($part[0] == $this->routerPrefix) {
            if ($echo) {
                echo $this->execute(WfalbumHelperCore::g($part[1], ''), '');
            } else {
                return $this->execute(WfalbumHelperCore::g($part[1], ''), '');
            }
        }
    }

    /**
     * Dispatcher for front end route!
     * The router comes is in format /routerPrefix/Controlle/Action!
     * THIS IS TO HANDLE ACTION ONLY, IT'S NOT GOINT TO RENDER CORRECT TEMPLATE!
     * THIS IS ONLY TO EXECUTE REQUEST WHICH NEED NO GOOD-LOOKING RESPONSE
     * @global WP_Query $wp_query
     */
    public function handleFrontendAction() {
        global $wp_query;
        $query = $wp_query->query;
        $pagename = WfalbumHelperCore::g($query['pagename'], null);
        $uri = WfalbumHelperCore::g($query['axcotouri'], null);

        $pagename = explode('/', $pagename, 2);
        if (count($pagename) && $pagename[0] == $this->routerPrefix) {
            $this->execute($pagename[1], 'frontend/');
        }
    }

    public function segment($num) {
        global $wp_query;
        static $uri = NULL;
        if (!$uri) {
            $query = $wp_query->query;
            $uri = $query['axcotouri'];
            $uri = explode('/', $uri);
        }

        if (is_numeric($num)) {
            return $uri[$num];
        }
    }

    public function menu() {
//        add_menu_page('wpfbalbum', 'WP FB Albums', 'manage_options', 'wfalbum/', array(&$this, 'handleBackendAction'), $this->pluginUrl . '/assets/images/icon.png');
//        add_submenu_page('wfalbum/', 'Setting', 'Setting', 'manage_options', 'wfalbum/setting/index', array('WfalbumOptionCore', 'setting_form'));
    }

    public function active() {
        global $wpdb;
    }

    public function deactive() {
        global $wpdb;
    }

    /**
     * Always return the same instance of plugin so we can access its property and its method
     * from anywhere
     * @return Wfalbum
     */
    static public function singleton() {
        if (!self::$_self) {
            self::$_self = new Wfalbum();
            self::$_self->init();
        }
        return self::$_self;
    }

    /**
     * Useful when using in admin! Can be used in Menu
     * This is designed specially for control>action model of this plugin
     * @param string $page
     * @param string $uri
     * @return string 
     */
    public function uri($page, $uri) {
        return 'admin.php?page=Wfalbum/' . $page . '&uri=Wfalbum/' . $uri;
    }
    
    /**
     * Return an absolute URL of a file in plugin folder
     * @param String $file
     * @return String 
     */
    public function url($file) {
        return $this->pluginUrl . $file;
    }

    static private $_self = null;
    const VERSION = '1.0';
    const POST_TYPE = 'wpfalbum';
    public $optionName = 'wfalbum';
    public $pluginUrl = NULL;
    public $pluginPath = '';
    public $pluginName = '';
    public $router = array();
    public $routerPrefix = 'wfalbum';
    public $baseSlug = 'wfalbum';
    public $styles = array(
        'wfalbum-all' => array('assets/css/axcoto.css', NULL, '1.0.0', 'all', 'auto'),
        'colorbox' => array('assets/js/colorbox/colorbox.css', NULL, '1.0.0', 'all', 'auto'),
    );
    public $scripts = array(
        //src, depend, version, in footer, [admin|frontend]
        //If set 5th element to admin or frontend it will autoload
        'wfalbum-app-core' => array('assets/js/app.js', array('jquery'), '1.0.0', true, 'auto'),
        'colorbox' => array('assets/js/colorbox/jquery.colorbox-min.js', array('jquery'), '1.0.0', true, 'admin'),
    );

}

global $wpfb_album;
$wpfb_album = Wfalbum::singleton();