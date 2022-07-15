<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diklat extends CI_Controller {
    public $nama;

	public function __construct()
    {
        parent::__construct();

        // Auth Check
        if($this->session->userdata('nip') == NULL) {
            $this->session->set_flashdata('message_success', 'Harap login terlebih dahulu!');
            redirect("auth/login");
        }
    }

    public function index()
    {
        // Load Model
        $this->load->model('diklat_model');
        $this->load->model('surat_model');
        $this->load->model('pegawai_model');

        // Get All "Diklat" by Pegawai NIP
        $list_diklat = $this->surat_model->get_all_where(array(
            "jenis" => "tugas",
            "jenis_kegiatan" => "diklat"
        ));

        // Get "Pegawai" by Pegawai NIP
        $pegawai_data = $this->pegawai_model->get_one(array(
            "account_nip" => $this->session->userdata('nip')
        ));

        // Get Detail from Detail Tujuan
        $list_detail_tujuan = [];
        foreach($list_diklat as $key => $value) {
            $list_detail = [];
            if($value->jenis_tujuan == 'divisi') {
                if($value->tujuan == 'jurusan') {
                    $detail_tujuan = explode(',', $value->detail_tujuan);
                    foreach($detail_tujuan as $item) {
                        $get_data = $this->jurusan_model->get_one([
                            "id" => $item
                        ]);
                        array_push($list_detail, $get_data);
                    }
                } else if($value->tujuan == 'bagian') {
                    $detail_tujuan = explode(',', $value->detail_tujuan);
                    foreach($detail_tujuan as $item) {
                        $get_data = $this->bagian_model->get_one([
                            "id" => $item
                        ]);
                        array_push($list_detail, $get_data);
                    }
                } else if($value->tujuan == 'unit') {
                    $detail_tujuan = explode(',', $value->detail_tujuan);
                    foreach($detail_tujuan as $item) {
                        $get_data = $this->unit_model->get_one([
                            "id" => $item
                        ]);
                        array_push($list_detail, $get_data);
                    }
                }
                $list_detail_tujuan[$key] = $list_detail;
            } else if($value->jenis_tujuan == 'perorangan') {
                $detail_tujuan = explode(',', $value->detail_tujuan);
                foreach($detail_tujuan as $item) {
                    $get_data = $this->pegawai_model->get_one([
                        "account_nip" => $item
                    ]);
                    array_push($list_detail, $get_data);
                }
                $list_detail_tujuan[$key] = $list_detail;
            }
        }

        $has_upload_hasil = [];
        $check_diklat = [];
        $list_diklat_berkas = [];
        $list_diklat_hasil = [];
        // Filter "Surat Tugas" Addressed to Account
        foreach($list_diklat as $key => $value) {
            if($this->session->userdata('role') != 'admin') {
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
                        unset($list_diklat[$key]);
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
                            unset($list_diklat[$key]);
                        }
                    } else {
                        unset($list_diklat[$key]);
                    }
                }
            }

            if(isset($list_diklat[$key])) {
                // Check if Diklat is Registered
                if($this->session->userdata('role') != 'admin') {
                    $status_check = $this->diklat_model->get_one(array(
                        "pegawai_nip" => $this->session->userdata('nip'),
                        "surat_id" => $value->id
                    ));
                } else {
                    $status_check = $this->diklat_model->get_one(array(
                        "surat_id" => $value->id
                    ));
                }

                if($status_check != NULL) {
                    if($status_check->file_materi != NULL && $status_check->sertifikat_id != NULL) {
                        $get_sertif_diklat = $this->diklat_model->get_one_join([
                            "diklat.id" => $status_check->id
                        ]);
                        $list_diklat_hasil[$value->id] = $get_sertif_diklat;
                        $has_upload_hasil[$value->id] = true;
                    } else {
                        $has_upload_hasil[$value->id] = false;
                    }
                }

                $check_diklat[$value->id] = ($status_check == NULL ? NULL : $status_check->id);
                $list_diklat_berkas[$value->id] = ($status_check == NULL ? NULL : $status_check);
            }
        }

        // Load View
        $this->load->view('partials/main-header', [
            "title" => " | Diklat"
        ]);
		$this->load->view('diklat/diklat', [
            "list_detail_tujuan" => $list_detail_tujuan,
            "list_diklat" => $list_diklat,
            "check_diklat" => $check_diklat,
            "has_upload_hasil" => $has_upload_hasil,
            "list_diklat_berkas" => $list_diklat_berkas,
            "list_diklat_hasil" => $list_diklat_hasil,
        ]);
		$this->load->view('partials/main-footer');
    }

    public function do_upload($file_type, $post_name)
    {
        // File
        $config['upload_path']          = './uploads';
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
        $this->load->model('diklat_model');
        $this->load->model('surat_model');

        $surat_id = $this->input->post('surat_id');
        // Get Surat
        $surat = $this->surat_model->get_one(array(
            "id" => $surat_id
        ));

        // POST Request and Upload File
        $file_foto_name = $this->do_upload("pdf", "file_foto");
        $file_ktp_name = $this->do_upload("pdf", "file_ktp");
        $file_kk_name = $this->do_upload("pdf", "file_kk");
        $file_ijazah_name = $this->do_upload("pdf", "file_ijazah");
        $file_surat_sehat_name = $this->do_upload("pdf", "file_surat_sehat");
        $file_tambahan_name = $this->do_upload("pdf", "file_tambahan");

        // File Validation
        if(is_null($file_foto_name && $file_ktp_name && $file_kk_name && $file_ijazah_name)) {
            $this->session->set_flashdata('message_error', 'Kesalahan dalam mengunggah file!');
            redirect("diklat");
        }

        $data = array(
            "jenis" => $surat->jenis_diklat,
            "foto" => $file_foto_name,
            "ktp" => $file_ktp_name,
            "kk" => $file_kk_name,
            "ijazah" => $file_ijazah_name,
            "surat_sehat" => $file_surat_sehat_name,
            "tambahan" => $file_tambahan_name,
            "surat_id" => $surat_id,
            "pegawai_nip" => $this->session->userdata('nip'),
            "created_at" => date("Y-m-d h:i:s")
        );

        $add = $this->diklat_model->insert_one($data);

        if($add) {
            $this->session->set_flashdata('message_success', 'Berhasil melakukan pemberkasan diklat!');
            redirect("diklat");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal melakukan pemberkasan diklat!');
            redirect("diklat");
        }
    }

    public function delete()
    {        
        $this->load->model('diklat_model');
        $id = $this->input->post('diklat_id');

        // Get Rows
        $get = $this->diklat_model->get_one(array(
            "id" => $id
        ));

        // Delete Rows and File Uploaded
        $delete = $this->diklat_model->delete_one($id);
        if($delete) {
            unlink("./uploads/".$get->foto);
            unlink("./uploads/".$get->ktp);
            unlink("./uploads/".$get->kk);
            unlink("./uploads/".$get->ijazah);
            $this->session->set_flashdata('message_success', 'Behasil membatalkan pemberkasan diklat!');
            redirect("diklat");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal membatalkan pemberkasan diklat!');
            redirect("diklat");
        }
    }

    public function hasil()
    {
        // Load Model
        $this->load->model('diklat_model');
        $this->load->model('sertifikat_model');

        // POST Request and Upload File
        $diklat_id = $this->input->post('diklat_id');
        $file_materi_name = $this->do_upload("pdf", "file_materi");
        $file_sertifikat_name = $this->do_upload("pdf", "file_sertifikat");
        $angka_kredit = $this->input->post('angka_kredit');

        // Validation
        if(is_null($file_materi_name && $file_sertifikat_name)) {
            $this->session->set_flashdata('message_success', 'Kesalahan dalam mengunggah file!');
            redirect("diklat");
        }

        $data_sertif = [
            "account_nip" => $this->session->userdata('nip'),
            "nama_serti" => $file_sertifikat_name
        ];

        $insert_sertif = $this->sertifikat_model->create_one($data_sertif);

        $data = [
            "angka_kredit" => $angka_kredit,
            "file_materi" => $file_materi_name,
            "sertifikat_id" => $insert_sertif
        ];

        $update = $this->diklat_model->update_one($diklat_id, $data);

        if($update) {
            $this->session->set_flashdata('message_success', 'Berhasil mengunggah hasil diklat!');
            redirect("diklat");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal mengunggah hasil diklat!');
            redirect("diklat");
        }
    }
}