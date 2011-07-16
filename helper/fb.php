<?php

/*
 * A project from Axcoto.Com
 * by kureikain
 */
global $wpfb_album;
include $wpfb_album->pluginPath . '/vendors/facebookphpsdk/src/facebook.php';

class WfalbumHelperFb {

    private $_api = null;
    private static $_self = null;
    private $_data = null;
    public $conf = null;
    public $user = null;
    public $isAuthorized = false;

    /**
     *
     * @return Axcoto_Facebook
     */
    public static function singleton() {
        if (!self::$_self) {
            self::$_self = new WfalbumHelperFb();
        }
        return self::$_self;
    }

    /**
     * Return the authentication url for our app! Users who go to app first time, will be lead to this url! Then after giving our app permission, he
     * will be by pass this page
     * @return <string> authenticate url
     */
    public function getAuthUrl() {
        $url = "http://www.facebook.com/dialog/oauth?client_id=%s&redirect_uri=%s&scope=";
        $redirect_url = $this->conf['canvas']['page'] . '?domain=' . get_bloginfo('url') . '&uid=' . get_current_user_id();
        return sprintf($url, $this->conf['core']['id'], urlencode($redirect_url) , $this->conf['scope']);
        //return "http://www.facebook.com/dialog/oauth?client_id=" . $this->conf['core']['id'] . "&redirect_uri=" . urlencode($this->conf['canvas']['page']) . '&scope=' . $this->conf['scope'];
    }

    /**
     *
     * @global Wfalbum $wpfb_album 
     */
    public function __construct() {
        global $wpfb_album;
        $option = get_option($wpfb_album->optionName);
        $this->conf = array(
            'appname' => 'wpfbalbum', //$option['canvas_url'],
            //This is a human name which can appear on wall or something! It should be easy to memorize, space and special char is ok
            'friendlyname' => 'WordPress Facebook Photos',
            //List of facebook user who you want to let him/her edit questions
            'admin' => array(
                0 => $option['fb_user_id']
            ),
            //These value you can grab from facebook application setting page
            'core' => array(
                'id' => '168649699868824', //$option['fb_app_id'],
                'secret' => '3800f10cd2e54ec6ae3c3a1e05e6e488', //$option['fb_app_secret']
            ),
            'scope' => 'user_photos,offline_access',
            'canvas' => array(
                'url' => 'http://cc.axcoto.com/wpfb-bridge/', //$option['fbapp_canvas_url'] . '/',
                'page' => 'https://apps.facebook.com/wpfbalbum/',
            )
        );
    }

    /**
     * Get facebook sdk instance
     *  @return Facebook
     */
    public function getApi() {
        if (empty($this->_api)) {
            $this->_api = new Facebook(array(
                        'appId' => $this->conf['core']['id'],
                        'secret' => $this->conf['core']['secret'],
                        'cookie' => true,
                    ));
        }
        return $this->_api;
    }

    
    public function getAlbums($fuid='') {
        if (!($albums = Axche::get('album_' . get_current_user_id(), 'wfalbum'))) {
            echo 'not in cache';
            $albums = $this->getApi()->api('624804112/albums', 'GET', array('access_token' => get_option('wfalbum_fb_access_token')));
            Axche::set('album_' . get_current_user_id(), $albums, 'wfalbum');
        }
        return $albums;
    }
    
    public function getPhotos($album_id) {
        if (!($photos = Axche::get('album_' . $album_id, 'wfalbum'))) {
            echo 'not in cache';
            $photos = $this->getApi()->api($album_id . '/photos', 'GET', array('access_token' => get_option('wfalbum_fb_access_token')));
            Axche::set('album_' . $album_id, $photos, 'wfalbum');
        }
        return $photos;
    }
    
    public function getPhoto($photo_id) {
        if (!($photo = Axche::get('photo_' . $photo_id, 'wfalbum'))) {
            echo 'not in cache';
            $photo = $this->getApi()->api($photo_id, 'GET', array('access_token' => get_option('wfalbum_fb_access_token')));
            Axche::set('photo_' . $photo_id, $photo, 'wfalbum');
        }
        
        return $photo;
    }
    

}