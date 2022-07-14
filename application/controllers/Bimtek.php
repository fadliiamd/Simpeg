<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bimtek extends CI_Controller {
    public $nama;

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('date_format');
    }

    public function index()
    {
        // Load Model
        $this->load->model('bimtek_model');
        $this->load->model('surat_model');
        $this->load->model('pegawai_model');

        // Get All "Bimtek" by Pegawai NIP
        $list_bimtek = $this->surat_model->get_all_where(array(
            "jenis" => "tugas",
            "jenis_kegiatan" => "bimtek"
        ));

        // Get "Pegawai" by Pegawai NIP
        $pegawai_data = $this->pegawai_model->get_one(array(
            "account_nip" => $this->session->userdata('nip')
        ));

        $has_upload_hasil = [];
        $check_bimtek = [];
        $list_bimtek_berkas = [];
        $list_bimtek_hasil = [];
        // Filter "Surat Tugas" Addressed to Account
        foreach($list_bimtek as $key => $value) {
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
                    unset($list_bimtek[$key]);
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
                        unset($list_bimtek[$key]);
                    }
                } else {
                    unset($list_bimtek[$key]);
                }
            }

            if(isset($list_bimtek[$key])) {
                // Check if Bimtek is Registered
                $status_check = $this->bimtek_model->get_one(array(
                    "pegawai_nip" => $this->session->userdata('nip'),
                    "surat_id" => $value->id
                ));

                if($status_check != NULL) {
                    if($status_check->file_materi != NULL && $status_check->sertifikat_id != NULL) {
                        $get_sertif_bimtek = $this->bimtek_model->get_one_join([
                            "bimtek.id" => $status_check->id
                        ]);
                        $list_bimtek_hasil[$value->id] = $get_sertif_bimtek;
                        $has_upload_hasil[$value->id] = true;
                    } else {
                        $has_upload_hasil[$value->id] = false;
                    }
                }

                $check_bimtek[$value->id] = ($status_check == NULL ? NULL : $status_check->id);
                $list_bimtek_berkas[$value->id] = ($status_check == NULL ? NULL : $status_check);
            }
        }

        // Load View
        $this->load->view('partials/main-header', [
            "title" => "Bimtek"
        ]);
		$this->load->view('bimtek/bimtek', [
            "list_bimtek" => $list_bimtek,
            "check_bimtek" => $check_bimtek,
            "has_upload_hasil" => $has_upload_hasil,
            "list_bimtek_berkas" => $list_bimtek_berkas,
            "list_bimtek_hasil" => $list_bimtek_hasil,
        ]);
		$this->load->view('partials/main-footer');
    }

    public function do_upload($file_type, $post_name)
    {
        // File
        $config['upload_path']          = './uploads/bimtek';
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
        $this->load->model('bimtek_model');
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
            redirect("bimtek");
        }

        $data = array(
            "jenis" => $surat->jenis_bimtek,
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

        $add = $this->bimtek_model->insert_one($data);

        if($add) {
            $this->session->set_flashdata('message_success', 'Berhasil melakukan pemberkasan bimtek!');
            redirect("bimtek");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal melakukan pemberkasan bimtek!');
            redirect("bimtek");
        }
    }

    public function delete()
    {        
        $this->load->model('bimtek_model');
        $id = $this->input->post('bimtek_id');

        // Get Rows
        $get = $this->bimtek_model->get_one(array(
            "id" => $id
        ));

        // Delete Rows and File Uploaded
        $delete = $this->bimtek_model->delete_one($id);
        if($delete) {
            unlink("./uploads/bimtek/".$get->foto);
            unlink("./uploads/bimtek/".$get->ktp);
            unlink("./uploads/bimtek/".$get->kk);
            unlink("./uploads/bimtek/".$get->ijazah);
            $this->session->set_flashdata('message_success', 'Behasil membatalkan pemberkasan bimtek!');
            redirect("bimtek");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal membatalkan pemberkasan bimtek!');
            redirect("bimtek");
        }
    }

    public function hasil()
    {
        // Load Model
        $this->load->model('bimtek_model');
        $this->load->model('sertifikat_model');

        // POST Request and Upload File
        $bimtek_id = $this->input->post('bimtek_id');
        $file_materi_name = $this->do_upload("pdf", "file_materi");
        $file_sertifikat_name = $this->do_upload("pdf", "file_sertifikat");

        // Validation
        if(is_null($file_materi_name && $file_sertifikat_name)) {
            $this->session->set_flashdata('message_success', 'Kesalahan dalam mengunggah file!');
            redirect("bimtek");
        }

        $data_sertif = [
            "account_nip" => $this->session->userdata('nip'),
            "nama_serti" => $file_sertifikat_name
        ];

        $insert_sertif = $this->sertifikat_model->create_one($data_sertif);

        $data = [
            "file_materi" => $file_materi_name,
            "sertifikat_id" => $insert_sertif
        ];

        $update = $this->bimtek_model->update_one($bimtek_id, $data);

        if($update) {
            $this->session->set_flashdata('message_success', 'Berhasil mengunggah hasil bimtek!');
            redirect("bimtek");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal mengunggah hasil bimtek!');
            redirect("bimtek");
        }
    }
}