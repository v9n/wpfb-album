<?php

/*
 * A project from Axcoto.Com
 * by kureikain
 */

class WfalbumWidgetAlbum extends WP_Widget {

    protected $_defaultSetting = array(
        'title' => 'My Facebook Album',
        'quantity' => 20,
        'mode' => 'normal',
        'width' => 50,
        'height' => 50,
        'album_id' => 0,
    );

    function _isRoot() {
        return get_current_user_id() == 1;
    }

    function __construct() {
        $widget_ops = array('classname' => 'WfalbumWidgetAlbum', 'description' => __('Display Facebook Albums'));
        parent::__construct('Wfalbum_album', __('FaceBook Album'), $widget_ops);
    }

    /**
     * Render setting form of widget
     * @param Object $instance setting of widget
     * @global Wfalbum $wpfb_album
     */
    function form($instance) {
        global $wpfb_album;
        if (!$this->_isRoot()) {
            echo 'Sorry, just root admin is alow to use this';
            return false;
        }
        $instance = array_merge($this->_defaultSetting, $instance);
        $fb = WfalbumHelperCore::load('fb', true);
        if (!$token = WfalbumHelperCore::getFbToken()) {
            include $wpfb_album->pluginPath . 'templates/auth.php';
            return false;
        }
        $albums = $fb->getAlbums();
        if (is_array($albums) && count($albums['data'])) {
            // outputs the options form on admin
            $title = esc_attr($instance['title']);
            $quantity = esc_attr($instance['quantity']);
            $width = esc_attr($instance['width']);
            $height = esc_attr($instance['height']);
            $album_id = esc_attr($instance['album_id']);
            $mode = esc_attr($instance['mode']);
            include Wfalbum::singleton()->pluginPath . '/templates/widget/album/form.php';
        } else {
            echo 'No Albums';
        }
    }

    /**
     * Update setting form of widget
     * @param Object $new_instance new setting of widget
     * @param Object $old_instance current setting of widget
     * @global Wfalbum $wpfb_album
     */
    function update($new_instance, $old_instance) {
        if (!$this->_isRoot()) {
            echo 'Sorry, just root admin is alow to use this';
            return false;
        }

        global $wpfb_album;
        // processes widget options to be saved
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['quantity'] = strip_tags($new_instance['quantity']);
        $instance['mode'] = strip_tags($new_instance['mode']);
        $instance['album_id'] = strip_tags($new_instance['album_id']);
        $instance['width'] = strip_tags($new_instance['width']);
        $instance['height'] = strip_tags($new_instance['height']);
        return $instance;
    }

    /**
     * Outputs the content of the widget
     * @param array $args
     * @param array $instance of current widget setting
     * @global Wfalbum $wpfb_album
     */
    function widget($args, $instance) {
        if (!$this->_isRoot()) {
            echo '';
            return false;
        }
        global $wpfb_album;
        extract($args);
        $instance = array_merge($this->_defaultSetting, $instance);
        $title = apply_filters('widget_title', $instance['title']);
        $fb = WfalbumHelperCore::load('fb', true);
        if (!$token = WfalbumHelperCore::getFbToken(1)) {
            return '';
        }
        $photos = $fb->getPhotos($instance['album_id']);
        if (is_array($photos['data'])) {
            include $wpfb_album->pluginPath . '/templates/widget/album/widget.php';
        } else {
            return '';
        }
    }

}