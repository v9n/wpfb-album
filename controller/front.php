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
        global $post;
        global $wpdb;
        $fb = WfalbumHelperCore::load('fb', true);
        if (!$token = WfalbumHelperCore::getFbToken()) {
            include $wpfb_album->pluginPath . 'templates/auth.php';
        } else {
            $albums = $fb->getAlbums();
            $count = 0;
            include $wpfb_album->pluginPath . 'templates/album/form.php';
        }
    }

    public function action_album($album_id) {
        WfalbumHelperCore::load('fb', false);
        $fb = new WfalbumHelperFb();
        $photos = $fb->getPhotos($album_id);
        var_dump($photos);
    }

}