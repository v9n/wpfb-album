<?php

/*
 * A project from Axcoto.Com
 * by kureikain
 */

class WfalbumHelperCore {

    static protected $_loaded = array();

    static public function log($message) {
        if (WP_DEBUG === true) {
            if (is_array($message) || is_object($message)) {
                error_log(print_r($message, true));
            } else {
                error_log($message);
            }
        }
    }

    static public function redirect($title, $message, $page, $url) {
        include AxcotoFontBird::singleton()->pluginPath . '/templates/common/redirect.php';
    }

    static public function e(&$value, $default='') {
        echo self::g($value, $default);
    }

    static public function g(&$value, $default='') {
        if (isset($value)) {
            return $value;
        } else {
            return $default;
        }
    }

    static public function load($file, $create = false) {
        if (empty(self::$_loaded['_' . $file])) {
            include dirname(__FILE__) . '/' . $file . '.php';
        }
        if ($create) {
            $class = 'WfalbumHelper' . ucfirst($file);
            return new $class;
        }
        return null;
    }

    /**
     * Get access token and facebook user id of current login user
     * @todo Get access token of any users
     * @staticvar array $token
     * @return FALSE if no valid token
     *          array($fbuid, $access_token) 
     */
    static public function getFbToken() {
        static $token = array();
        if (!$token) {
            $user_id = get_current_user_id();
            $fbuid = get_user_meta($user_id, 'wfalbum_fbuid', true);
            $access_to = get_user_meta($user_id, 'wfalbum_access_token', true);
            if (!$fbuid || !$access_to) {
                return FALSE;
            }
            $token = array(
                $fbuid, $access_to
            );
        }

        return $token;
    }

    static public function setFbToken($user_id, $fbuid, $access_token) {
        update_user_meta($user_id, 'wfalbum_access_token', $access_token);
        update_user_meta($user_id, 'wfalbum_fbuid', $fbuid);
        return true;
    }

}