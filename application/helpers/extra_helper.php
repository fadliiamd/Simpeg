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

function is_kepegawaian($pegawai){                                    
    if (!is_null($pegawai)) {
        $pegawai = $pegawai->nama_bagian;
        if(strtolower($pegawai) == 'kepegawaian'){
            return true;
        }
    }
    return false;
}

function is_wadir($pegawai){                                    
    if (!is_null($pegawai)) {        
        if($pegawai->jabatan_id == 9 || $pegawai->jabatan_id == 10){
            return true;
        }
    }
    return false;
}
/* End of file extra.php */
/* Location: ./application/helpers/extra.php */