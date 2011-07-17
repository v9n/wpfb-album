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

    /**
     * Show all albums of an user
     */
    public function action_load_albums() {
        global $wpfb_album;
        global $post;
        global $wpdb;
        $fb = WfalbumHelperCore::load('fb', true);
        $cache = WfalbumHelperCore::g($_REQUEST['force'], 0) == 0;
        if (!$token = WfalbumHelperCore::getFbToken()) {
            include $wpfb_album->pluginPath . 'templates/auth.php';
        } else {
            $albums = $fb->getAlbums(NULL, $cache);
            $count = 0;
            foreach ($albums['data'] as $keys => $album) {
                $album_cover = $fb->getPhoto($album['cover_photo'], $cache);
                foreach ($album_cover['images'] as $image) {
                    if ($image['width'] == 180) {
                        $album_cover = $image;
                        break;
                    }
                }
                ?>
                <div class="wfalbum_item" id="wfalbum_item_<?php echo $album['id'] ?>" rel="<?php echo $album['id'] ?>">
                    <a title="" href='#'><img src='<?php echo $album_cover['source'] ?>' border='0' alt="" title="" /></a>
                    <span><?php echo $album['name'] ?> // <?php echo $album['count'] ?> photos</span>
                </div>
                <?php
            }
        }
    }

    /**
     * Show all photos of an album
     * @param type $album_id 
     */
    public function action_album($album_id) {
        WfalbumHelperCore::load('fb', false);
        $fb = new WfalbumHelperFb();
        $photos = $fb->getPhotos($album_id);
        var_dump($photos);
    }

}