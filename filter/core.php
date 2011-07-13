<?php

/*
 * A project from Axcoto.Com
 * by kureikain
 */

class WfalbumFilterCore {

    /**
     * Add our custom query varrible
     * @param array $query_vars
     * @return array modified query vars
     */
    public static function query_vars($query_vars) {
        array_push($query_vars, 'axcotouri');
        return $query_vars;
    }


}

?>
