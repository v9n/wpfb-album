<?php

/*
 *  A venture of Axcoto http://axcoto.com
 *  by Vincent Nguyen <info@axcoto.com>
 */
if (!class_exists('Axche')) {

    class Axche {

        static protected $_config = array(
            'dir' => '',
            'exp' => 300
        );

        static public function init($config) {
            self::$_config = array_merge(self::$_config, $config);
        }

        /**
         *
         * @param string $name
         * @param mixed $value of cache
         * @param string group to avoid override cache with the same name
         * @param int $exp amount of time in second which cache lives 
         */
        static public function set($name, $value, $group='default', $exp=NULL) {
            if (NULL === $exp) {
                $exp = self::$_config['exp'];
            }
            if (!file_exists($cachedir = self::$_config['dir'] . $group . '/')) {
                mkdir($cachedir);
            }
            $cachefile = $cachedir . md5($name);
            $content = implode("\n", array(time() + $exp, serialize($value),));
            file_put_contents($cachefile, $content);
        }

        /**
         * Getting cache val
         * @param string $name
         * @param string $group of cache if you set it when use self::set
         * @param mixed $default value
         * @return mixed
         */
        static public function get($name, $group='default', $default=NULL) {
            $cachefile = (self::$_config['dir'] . $group . '/' . md5($name));
            if (!file_exists($cachefile)) {
                return $default;
            }
            $content = file_get_contents($cachefile);
            if (!$content) {
                return $default;
            }
            $content = explode("\n", $content, 2);
            if (time()>=$content[0]) {
                //Cache is expired, clear it
                @unlink($cachefile);
                return $default;
            }
            return unserialize($content[1]);
        }

    }

}