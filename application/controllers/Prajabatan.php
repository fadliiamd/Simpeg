<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prajabatan extends CI_Controller {
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
        $this->load->model('prajabatan_model');
        $this->load->model('surat_model');
        $this->load->model('pegawai_model');
        $this->load->model('bagian_model');
        $this->load->model('jabatan_model');

        // Get All "Prajabatan" by Pegawai NIP
        $list_prajabatan = $this->surat_model->get_all_where(array(
            "jenis_kegiatan" => "prajabatan",
            "status" => 'sent'
        ));

        // Get "Pegawai" by Pegawai NIP
        $pegawai_data = $this->pegawai_model->get_one(array(
            "account_nip" => $this->session->userdata('nip')
        ));

        // Get Detail from Detail Tujuan
        $list_detail_tujuan = [];
        foreach($list_prajabatan as $key => $value) {
            $list_detail = [];
            if($value->jenis_tujuan == 'divisi') {
                if($value->tujuan == 'jurusan') {
                    $detail_tujuan = $this->surat_model->get_all_where_subjek([
                        "surat_id" => $value->id
                    ]);
                    foreach($detail_tujuan as $item) {
                        $get_data = $this->jurusan_model->get_one([
                            "id" => $item->subjek
                        ]);
                        array_push($list_detail, $get_data);
                    }
                } else if($value->tujuan == 'bagian') {
                    $detail_tujuan = $this->surat_model->get_all_where_subjek([
                        "surat_id" => $value->id
                    ]);
                    foreach($detail_tujuan as $item) {
                        $get_data = $this->bagian_model->get_one([
                            "id" => $item->subjek
                        ]);
                        array_push($list_detail, $get_data);
                    }
                } else if($value->tujuan == 'unit') {
                    $detail_tujuan = $this->surat_model->get_all_where_subjek([
                        "surat_id" => $value->id
                    ]);
                    foreach($detail_tujuan as $item) {
                        $get_data = $this->unit_model->get_one([
                            "id" => $item->subjek
                        ]);
                        array_push($list_detail, $get_data);
                    }
                }
                $list_detail_tujuan[$value->id] = $list_detail;
            } else if($value->jenis_tujuan == 'perorangan') {
                $detail_tujuan = $this->surat_model->get_all_where_subjek([
                    "surat_id" => $value->id
                ]);
                foreach($detail_tujuan as $item) {
                    $get_data = $this->pegawai_model->get_one([
                        "account_nip" => $item->subjek
                    ]);
                    array_push($list_detail, $get_data);
                }
                $list_detail_tujuan[$value->id] = $list_detail;
            }
        }

        $has_upload_hasil = [];
        $check_prajabatan = [];
        $list_prajabatan_berkas = [];
        $list_prajabatan_hasil = [];
        // Filter "Surat Tugas" Addressed to Account
        foreach($list_prajabatan as $key => $value) {
            if($this->session->userdata('role') != 'admin') {
                if($value->jenis_tujuan == 'perorangan') {
                    $detail_tujuan = $this->surat_model->get_all_where_subjek([
                        "surat_id" => $value->id
                    ]);

                    // Compare "tujuan_detail" and Pegawai NIP
                    $found = false;
                    foreach($detail_tujuan as $value2) {
                        if($value2->subjek == $this->session->userdata('nip')) {
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
                        $detail_tujuan = $this->surat_model->get_all_where_subjek([
                            "surat_id" => $value->id
                        ]);

                        // Compare "tujuan_detail" and Pegawai Divisi
                        $found = false;
                        foreach($detail_tujuan as $value2) {
                            if($value2->subjek == $divisi_id) {
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
            }

            if(isset($list_prajabatan[$key])) {
                // Check if Prajabatan is Registered
                if($this->session->userdata('role') != 'admin') {
                    $status_check = $this->prajabatan_model->get_one(array(
                        "pegawai_nip" => $this->session->userdata('nip'),
                        "surat_id" => $value->id
                    ));
                } else {
                    $status_check = $this->prajabatan_model->get_one(array(
                        "surat_id" => $value->id
                    ));
                }

                if($status_check != NULL) {
                    if($status_check->file_materi != NULL && $status_check->sertifikat_id != NULL) {
                        $get_sertif_prajabatan = $this->prajabatan_model->get_one_join([
                            "prajabatan.id" => $status_check->id
                        ]);
                        $list_prajabatan_hasil[$value->id] = $get_sertif_prajabatan;
                        $has_upload_hasil[$value->id] = true;
                    } else {
                        $has_upload_hasil[$value->id] = false;
                    }
                }

                $check_prajabatan[$value->id] = ($status_check == NULL ? NULL : $status_check->id);
                $list_prajabatan_berkas[$value->id] = ($status_check == NULL ? NULL : $status_check);
            }
        }

        // Get List Jabatan
        $jabatan = $this->jabatan_model->get_all();
        $list_jabatan = [];
        foreach($jabatan as $value) {
            $list_jabatan[$value->id] = $value; 
        }

        // Load View
        $this->load->view('partials/main-header', [
            "title" => " | Prajabatan"
        ]);
		$this->load->view('prajabatan/prajabatan', [
            "list_detail_tujuan" => $list_detail_tujuan,
            "list_prajabatan" => $list_prajabatan,
            "check_prajabatan" => $check_prajabatan,
            "has_upload_hasil" => $has_upload_hasil,
            "list_prajabatan_berkas" => $list_prajabatan_berkas,
            "list_prajabatan_hasil" => $list_prajabatan_hasil,
            "list_jabatan" => $list_jabatan
        ]);
		$this->load->view('partials/main-footer');
    }

    public function do_upload($file_type, $post_name, $file_name="")
    {
        // File
        $config['upload_path']          = './uploads';
        $config['allowed_types']        = $file_type;
        $config['max_size']             = 2048;
        if($file_name!==""){            
            $config['file_name'] = $file_name;
        }
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
            redirect("prajabatan");
        }

        $data = array(
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
            unlink("./uploads/".$get->foto);
            unlink("./uploads/".$get->ktp);
            unlink("./uploads/".$get->kk);
            unlink("./uploads/".$get->ijazah);
            $this->session->set_flashdata('message_success', 'Behasil membatalkan pemberkasan prajabatan!');
            redirect("prajabatan");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal membatalkan pemberkasan prajabatan!');
            redirect("prajabatan");
        }
    }

    public function hasil()
    {
        // Load Model
        $this->load->model('prajabatan_model');
        $this->load->model('sertifikat_model');

        // POST Request and Upload File
        $prajabatan_id = $this->input->post('prajabatan_id');
        $file_materi_name = $this->do_upload("pdf", "file_materi");

        //get tema
        $tema = $this->prajabatan_model->get_tema(["prajabatan.id" => $prajabatan_id]);
        $ext = end(explode(".", $_FILES["file_sertifikat"]['name']));
        $serti_name = time().'-'.$tema.'-file'. $ext;
        $file_sertifikat_name = $this->do_upload("pdf", "file_sertifikat", $serti_name);        

        $angka_kredit = $this->input->post('angka_kredit');

        // Validation
        if(is_null($file_materi_name && $file_sertifikat_name)) {
            $this->session->set_flashdata('message_success', 'Kesalahan dalam mengunggah file!');
            redirect("prajabatan");
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

        $update = $this->prajabatan_model->update_one($prajabatan_id, $data);

        if($update) {
            $this->session->set_flashdata('message_success', 'Berhasil mengunggah hasil prajabatan!');
            redirect("prajabatan");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal mengunggah hasil prajabatan!');
            redirect("prajabatan");
        }
    }
}