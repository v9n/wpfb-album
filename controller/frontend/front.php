<?php

class WfalbumFrontController {

    /**
     *
     * @global Wfalbum $wpfb_album
     * @global wpdb $wpdb
     * @var Facebook $fb
     */
    public function action_index() {
        global $wpfb_album;
        global $wpdb;
        WfalbumHelperCore::load('fb', false);
        $fb = new WfalbumHelperFb();
        $facebook = $fb->getApi();
        $session = $facebook->getSession();

        $me = null;
// Session based API call.
        if ($session) {
            try {
                $uid = $facebook->getUser();
                $me = $facebook->api('/me');
                $access_token = $facebook->getAccessToken();
                update_option('wfalbum_fb_access_token', $access_token);
                include $wpfb_album->pluginPath . '/templates/frontpage/index.php';
            } catch (FacebookApiException $e) {
                echo $e->getMessage();
                error_log($e);
            } catch (Exception $e) {
                error_log($e);
                echo $e->getMessage();
            }
        }
    }

    /**
     * In order to reduce procedure for setting up a Facebook application on client (it can be very hard for some of client), I think of
     * an other way for this! I will set up a central facebook app to server for all clients!
     * Each client (who bought and use this plugin) need to authorized my facebook app and give my facebook app two permisson: offline_access, 
     * and user_photo! After user authorized my app, my app then ping to site of client at url
     * /wfalbum/save_token/{user_id_on_wordpress}/access_token
     * This url is handle by my plugin: wfalbum! It then save this access_token! 
     * Because this is an offline_access token so I can used it later in my plugin to gather information about user photo
     * 
     * @global wpdb $wpdb;
     * @global Wfalbum $wpfb_album
     * @param $user_id id of user on WordPress! When user get redirecting to my facebook app to authorize, this user_id will be passed to my facebook app too!
     */
    public function action_save_token($hash=NULL) {
        global $wpdb, $wpfb_album;
        $hash = base64_decode($hash);
        $hash = explode(',', $hash, 3);
        if (count($hash) < 3) {
            echo 'fail';
        } else {
            WfalbumHelperCore::setFbToken($hash[0], $hash[1], $hash[2]);
            echo 'success';
        }
        exit;
    }

}