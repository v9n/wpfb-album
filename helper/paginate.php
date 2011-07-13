<?php

/*
 * A project from Axcoto.Com
 * by kureikain
 */

class AxcotoHelperPaginate {

    public function render($args) {
        $defaultArgs = array(
            'total' => 0,
            'current' => 0,
            'uri' => 0,
            'post_per_page' => 10
        );
        $args = wp_parse_args($args, $defaultArgs);
        $args['total_page'] = ceil($args['total'] / $args['[post_per_page']);
        include DevgmDona::singleton()->pluginPath . 'templates/pagination/default.php';
    }

}

