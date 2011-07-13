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
        //echo $fb->getAuthUrl(), "\n<br />";

        $facebook = $fb->getApi();
        $albums = $facebook->api('624804112/albums', 'GET', array('access_token' => get_option('wfalbum_fb_access_token')));
        
        $count = 0;
        foreach ($albums['data'] as $keys => $album) {
            if ($count++>=10) {
                break;
            }
            //we will do another query
            //to get album cover
            $fqlResult2 = $facebook->api($album['cover_photo'], 'GET', array('access_token' => get_option('wfalbum_fb_access_token')));
            $album_cover = $fqlResult2['images'][3]['source'];
            
            echo "<div style='padding: 10px; width: 150px; height: 170px; float: left;'>";
            echo "<a href='admin.php?page=wfalbum&uri=wfalbum/front/album/" . $album['id'] .  "'>";
            echo "<img src='$album_cover' border='1'>";
            echo "</a><br />";
            echo $values['name'];
            echo "</div>";
            
        }

    }

    public function action_album($album_id) {
        WfalbumHelperCore::load('fb', false);
        $fb = new WfalbumHelperFb();
        $photos = $fb->getPhotos($album_id);
        var_dump($photos);
    }
}