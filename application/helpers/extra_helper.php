<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

function findObjectBy($key, $value, $array) {
    foreach ($array as $item) {
        if (isset($item->$key) && $item->$key == $value) {
            return $item;
        }
    }
    return false;
}

/* End of file extra.php */
/* Location: ./application/helpers/extra.php */