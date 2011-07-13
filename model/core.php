<?php

/*
 * A project from Axcoto.Com
 * by kureikain
 */

class FilebirdModelCore {

    private static $_models = array();
    
    public static function loadModel($name) {
        if (!empty(self::$_models[$name])) {
            return self::$_models[$name];
        }
        $classname = 'DevgmModel' . ucfirst($name);
        include dirname(__FILE__) . '/' . $name . '.php';
        self::$_models[$name] = new $classname();
        return self::$_models[$name];
    }

}
