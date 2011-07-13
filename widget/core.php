<?php

/*
 * A project from Axcoto.Com
 * by kureikain
 */

class WfalbumWidgetCore {

    private static $_loaded = false;

    public static function init() {
        if (self::$_loaded) {
            return false;
        }
        self::$_loaded = true;

        $dir = dirname(__FILE__);
        if ($handle = opendir($dir)) {
            /* This is the correct way to loop over the directory. */
            while (false !== ($file = readdir($handle))) {
                if (substr($file, -3) == 'php' && $file != 'core.php') {
                    include $dir . '/' . $file;
                    $classname = substr($file, 0, strlen($file) - 4);
                    if (class_exists($classname = 'WfalbumWidget' . ucfirst($classname))) {
                        register_widget($classname);
                    }
                }
            }
            closedir($handle);
        }
    }

}