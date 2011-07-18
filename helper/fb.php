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
        $url = "http://www.facebook.com/dialog/oauth?client_id=%s&redirect_uri=%s&scope=%s";
        $redirect_url = $this->conf['canvas']['page'] . '?domain=' . get_bloginfo('url') . '&uid=' . get_current_user_id();
        return sprintf($url, $this->conf['core']['id'], urlencode($redirect_url), $this->conf['scope']);
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
                'page' => 'http://apps.facebook.com/wpfbalbum/',
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

    /**
     * get album of current user!
     * 
     * @param type $fuid
     * @return 
     *  array of album!
     *  false if current user has not valid token         
     */
    public function getAlbums($fuid='', $cache=true) {
        if (!$cache) {
            Axche::remove('album_' . get_current_user_id(), 'wfalbum');
        }
        if (!($albums = Axche::get('album_' . get_current_user_id(), 'wfalbum'))) {
            WfalbumHelperCore::log('album_' . get_current_user_id() . 'wfalbum' . ' not in cache');
            $token = WfalbumHelperCore::getFbToken();
            if ($token && count($token) == 2) {
                $albums = $this->getApi()->api($token[0] . '/albums', 'GET', array('access_token' => $token[1]));
                Axche::set('album_' . get_current_user_id(), $albums, 'wfalbum');
            } else {
                return false;
            }
        }
        return $albums;
    }

    public function getPhotos($album_id, $cache=true) {
        if (!$cache) {
            Axche::remove('album_' . $album_id, 'wfalbum');
        }

        if (!($photos = Axche::get('album_' . $album_id, 'wfalbum'))) {
            WfalbumHelperCore::log('album_' . $album_id . 'wfalbum' . ' not in cache');
            $token = WfalbumHelperCore::getFbToken();
            if ($token && count($token) == 2) {
                $photos = $this->getApi()->api($album_id . '/photos', 'GET', array('access_token' => $token[1]));
                Axche::set('album_' . $album_id, $photos, 'wfalbum');
            } else {
                return false;
            }
        }
        return $photos;
    }

    public function getPhoto($photo_id, $cache=true) {
        if (!$cache) {
            Axche::remove('photo_' . $photo_id, 'wfalbum');
        }

        if (!($photo = Axche::get('photo_' . $photo_id, 'wfalbum'))) {
            WfalbumHelperCore::log('photo_' . $photo_id . 'wfalbum' . ' not in cache');
            $token = WfalbumHelperCore::getFbToken();
            if ($token && count($token) == 2) {
                $photo = $this->getApi()->api($photo_id, 'GET', array('access_token' => $token[1]));
                Axche::set('photo_' . $photo_id, $photo, 'wfalbum');
            } else {
                return false;
            }
        }

        return $photo;
    }

}
