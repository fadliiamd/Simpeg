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
        if(!is_null($pegawai)){
            if(strtolower($pegawai) == 'kepegawaian'){
                return true;
            }
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

function get_number_usulan($id, $usulan){
    $number = 1;
    $is_ada = false;
    foreach ($usulan as $item) {
        if($item->id == $id){
            $is_ada = true;
            break;
        }else{
            $number++;
        }
    }
    if($is_ada){
        return $number;
    }else{
        return 0;
    }    
}

function get_jabatan($id){
    $CI =& get_instance();
    $CI->load->model('Jabatan_model');
    $jabatan = $CI->Jabatan_model->get_one(["id" => $id]);    
    if($jabatan){
        return $jabatan->nama_jabatan;
    }else{
        return null;
    }
}

function get_pegawai($nip)
{
    $CI =& get_instance();
    $CI->load->model('Pegawai_model');
    $pegawai = $CI->Pegawai_model->get_one(["account_nip" => $nip]);
    if($pegawai){
        return $pegawai;
    }else{
        return null;
    }
}
/* End of file extra.php */
/* Location: ./application/helpers/extra.php */