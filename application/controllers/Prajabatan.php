<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prajabatan extends CI_Controller {
    public $nama;

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('date_format');
    }

    public function index()
    {
        // Load Model
        $this->load->model('prajabatan_model');
        $this->load->model('surat_model');
        $this->load->model('pegawai_model');

        // Get All "Prajabatan" by Pegawai NIP
        $list_prajabatan = $this->surat_model->get_all_where(array(
            "jenis" => "tugas",
            "jenis_kegiatan" => "prajabatan"
        ));

        // Get "Pegawai" by Pegawai NIP
        $pegawai_data = $this->pegawai_model->get_one(array(
            "account_nip" => $this->session->userdata('nip')
        ));

        $check_prajabatan = array();
        $list_prajabatan_id = array();
        // Filter "Surat Tugas" Addressed to Account
        foreach($list_prajabatan as $key => $value) {
            if($value->jenis_tujuan == 'perorangan') {
                $detail_tujuan = explode(',',$value->detail_tujuan);

                // Compare "tujuan_detail" and Pegawai NIP
                $found = false;
                foreach($detail_tujuan as $value2) {
                    if($value2 == $this->session->userdata('nip')) {
                        $found = true;
                        break;
                    }
                }
                if($found == false) {
                    unset($list_prajabatan[$key]);
                }

            } else if($value->jenis_tujuan == 'divisi') {
                // Check Type of "Divisi"
                if($value->tujuan == 'jurusan') {
                    $divisi_id = $pegawai_data->jurusan_id;
                } else if($value->tujuan == 'bagian') {
                    $divisi_id = $pegawai_data->bagian_id;
                } else if($value->tujuan == 'unit') {
                    $divisi_id = $pegawai_data->unit_id;
                } else {
                    $divisi_id = NULL;
                }

                if($divisi_id != NULL) {
                    $detail_tujuan = explode(',',$value->detail_tujuan);

                    // Compare "tujuan_detail" and Pegawai Divisi
                    $found = false;
                    foreach($detail_tujuan as $value2) {
                        if($value2 == $divisi_id) {
                            $found = true;
                            break;
                        }
                    }
                    if($found == false) {
                        unset($list_prajabatan[$key]);
                    }
                } else {
                    unset($list_prajabatan[$key]);
                }
            }

            if(isset($list_prajabatan[$key])) {
                // Check if Prajabatan is Registered
                $status_check = $this->prajabatan_model->get_one(array(
                    "pegawai_nip" => $this->session->userdata('nip'),
                    "surat_id" => $value->id
                ));

                $check_prajabatan[$key] = ($status_check == NULL ? false : true);
                $list_prajabatan_id[$key] = ($status_check == NULL ? NULL : $status_check->id);
            }
        }

        // Load View
        $this->load->view('partials/main-header');
		$this->load->view('prajabatan/prajabatan', [
            "list_prajabatan" => $list_prajabatan,
            "check_prajabatan" => $check_prajabatan,
            "list_prajabatan_id" => $list_prajabatan_id
        ]);
		$this->load->view('partials/main-footer');
    }

    public function do_upload($file_type, $post_name)
    {
        // File
        $config['upload_path']          = './uploads/prajabatan';
        $config['allowed_types']        = $file_type;
        $config['max_size']             = 2048;
        $this->load->library('upload');

        $this->upload->initialize($config);
        $data = null;

        if (($this->upload->do_upload($post_name))) {
            $data = $this->upload->data();
            $data = $data['file_name'];
        }

        return $data;
    }

    public function create()
    {
        // Load Model
        $this->load->model('prajabatan_model');
        $this->load->model('surat_model');

        $surat_id = $this->input->post('surat_id');
        // Get Surat
        $surat = $this->surat_model->get_one(array(
            "id" => $surat_id
        ));

        $file_foto_name = $this->do_upload("pdf", "file_foto");
        $file_ktp_name = $this->do_upload("pdf", "file_ktp");
        $file_kk_name = $this->do_upload("pdf", "file_kk");
        $file_ijazah_name = $this->do_upload("pdf", "file_ijazah");

        if(is_null($file_foto_name)) {
            echo $this->input->post('file_foto');
            die();
        }
        if(is_null($file_ktp_name)) {
            echo $this->input->post('file_ktp');
            die();
        }
        if(is_null($file_kk_name)) {
            echo $this->input->post('file_kk');
            die();
        }
        if(is_null($file_ijazah_name)) {
            echo $this->input->post('file_ijazah');
            die();
        }

        date_default_timezone_set('Asia/Jakarta');
        $date =  date("Y/m/d h:i:s");
        $tgl_upload =  $date;

        $data = array(
            "foto" => $file_foto_name,
            "ktp" => $file_ktp_name,
            "kk" => $file_kk_name,
            "ijazah" => $file_ijazah_name,
            "surat_id" => $surat_id,
            "pegawai_nip" => $this->session->userdata('nip'),
            "created_at" => $tgl_upload
        );

        $add = $this->prajabatan_model->insert_one($data);

        if($add) {
            $this->session->set_flashdata('message_success', 'Berhasil melakukan pemberkasan prajabatan!');
            redirect("prajabatan");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal melakukan pemberkasan prajabatan!');
            redirect("prajabatan");
        }
    }

    public function delete()
    {        
        $this->load->model('prajabatan_model');
        $id = $this->input->post('prajabatan_id');

        // Get Rows
        $get = $this->prajabatan_model->get_one(array(
            "id" => $id
        ));

        // Delete Rows and File Uploaded
        $delete = $this->prajabatan_model->delete_one($id);
        if($delete) {
            unlink("./uploads/prajabatan/".$get->foto);
            unlink("./uploads/prajabatan/".$get->ktp);
            unlink("./uploads/prajabatan/".$get->kk);
            unlink("./uploads/prajabatan/".$get->ijazah);
            $this->session->set_flashdata('message_success', 'Behasil membatalkan pemberkasan prajabatan!');
            redirect("prajabatan");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal membatalkan pemberkasan prajabatan!');
            redirect("prajabatan");
        }
    }
}