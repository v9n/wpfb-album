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

        $albums = $fb->getAlbums();        
        $count = 0;
        foreach ($albums['data'] as $keys => $album) {
            $photos = $fb->getPhotos($album['id']);
            $album_cover = empty($photos['data'][0]['images'][3])? '':$photos['data'][0]['images'][3]['source'];
            echo "<div style='padding: 10px; width: 150px; height: 170px; float: left;'>";
            echo "<a href='admin.php?page=wfalbum&uri=wfalbum/front/album/" . $album['id'] . "'>";
            echo "<img src='$album_cover' border='1'>";
            echo "</a><br />";
            echo $album['name'];
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