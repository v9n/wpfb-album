<?php

/*
 * A project from Axcoto.Com
 * by kureikain
 */

class WfalbumWidgetAlbum extends WP_Widget {

    protected $_defaultSetting = array(
        'title' => 'Facebook Album',
        'quantity' => '20',
        'type' => 'fancy',
    );
    
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
        if (!current_user_can('manage_option')) {
            echo 'Sorry, just admin is alow to use this';
            return false;
        }
        // outputs the options form on admin
        $title = esc_attr($instance['title']);
        $quantity = esc_attr($instance['quantity']);
        $type = esc_attr($instance['type']);
        include Wfalbum::singleton()->pluginPath . '/templates/widget/album/form.php';
    }

    /**
     * Update setting form of widget
     * @param Object $new_instance new setting of widget
     * @param Object $old_instance current setting of widget
     * @global Wfalbum $wpfb_album
     */
    function update($new_instance, $old_instance) {
        if (!current_user_can('manage_option')) {
            echo 'Sorry, just admin is alow to use this';
            return false;
        }

        global $wpfb_album;
        // processes widget options to be saved
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['quantity'] = strip_tags($new_instance['quantity']);
        $instance['type'] = strip_tags($new_instance['type']);
        return $instance;
    }

    /**
     * Outputs the content of the widget
     * @param array $args
     * @param array $instance of current widget setting
     * @global Wfalbum $wpfb_album
     */
    function widget($args, $instance) {
        global $wpfb_album;
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $classname = 'DevgmCauseGroupFinder' . ucfirst($instance['type']);
        $finder = new $classname();
        $groups = $finder->find(array('num' => $instance['quantity'], 'order' => $instance['order']));
        include $wpfb_album->pluginPath . '/templates/widget/album/widget.php';
        
    }

}