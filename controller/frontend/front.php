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
    
    

}